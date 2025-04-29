<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Transaction;
use App\Utils\TransactionUtil;
use App\Utils\ModuleUtil;
use App\Utils\ProductUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Product;
use App\Variation;
use App\ProductVariation;
use App\BusinessLocation;

class ManualSellController extends Controller
{
    /**
     * All Utils instance.
     */
    protected $transactionUtil;
    protected $moduleUtil;
    protected $productUtil;

    /**
     * Constructor
     */
    public function __construct(
        TransactionUtil $transactionUtil,
        ModuleUtil $moduleUtil,
        ProductUtil $productUtil
    ) {
        $this->transactionUtil = $transactionUtil;
        $this->moduleUtil = $moduleUtil;
        $this->productUtil = $productUtil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->action([ManualSellController::class, 'create']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('sell.create')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');

        //Check if subscribed or not
        if (!$this->moduleUtil->isSubscribed($business_id)) {
            return $this->moduleUtil->expiredResponse();
        }

        // Instead of using getWalkInCustomer, get the default customer directly
        $walk_in_customer = Contact::where('business_id', $business_id)
                            ->where('type', 'customer')
                            ->where('is_default', 1)
                            ->first();
        
        $contacts = Contact::where('business_id', $business_id)
                    ->whereIn('type', ['customer', 'both'])
                    ->active()
                    ->pluck('name', 'id');

        // Generate a new invoice number
        $ref_count = $this->transactionUtil->setAndGetReferenceCount('sell');
        $invoice_no = $this->transactionUtil->generateReferenceNumber('sell', $ref_count);

        return view('sell.manual.create')
            ->with(compact('walk_in_customer', 'contacts', 'invoice_no'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('sell.create')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $input = $request->except('_token');
            
            $business_id = $request->session()->get('user.business_id');
            $user_id = $request->session()->get('user.id');

            DB::beginTransaction();

            // Get or create a manual product for this business
            $manual_product = $this->getOrCreateManualProduct($business_id);

            // Get default business location
            $default_location = BusinessLocation::where('business_id', $business_id)
                                ->first();
            
            if (empty($default_location)) {
                throw new \Exception("No business location found");
            }

            // Store eye measurements and other custom fields
            $custom_fields = [
                'od_measurement' => $input['od_measurement'] ?? null,
                'og_measurement' => $input['og_measurement'] ?? null,
                'midar' => $input['midar'] ?? null
            ];

            // Calculate total
            $final_total = 0;
            foreach ($input['products'] as $product) {
                $quantity = !empty($product['quantity']) ? $product['quantity'] : 1;
                $price = !empty($product['price']) ? $product['price'] : 0;
                $final_total += ($quantity * $price);
            }

            // Prepare transaction data for TransactionUtil
            $transaction_data = [
                'business_id' => $business_id,
                'location_id' => $default_location->id,
                'type' => 'sell',
                'status' => 'final',
                'contact_id' => $input['contact_id'],
                'invoice_no' => $input['invoice_number'] ?? null,
                'transaction_date' => $input['transaction_date'] ?? date('Y-m-d H:i:s'),
                'total_before_tax' => $final_total,
                'final_total' => $final_total,
                'created_by' => $user_id,
                'custom_field_1' => json_encode($custom_fields),
                'is_direct_sale' => 1,
                'commission_agent' => null,
                'is_quotation' => 0,
                'shipping_status' => null,
                'shipping_address' => null,
                'shipping_charges' => 0,
                'exchange_rate' => 1,
                'selling_price_group_id' => null,
                'pay_term_number' => null,
                'pay_term_type' => null,
                'is_suspend' => 0,
                'is_recurring' => 0,
                'recur_interval' => null,
                'recur_interval_type' => null,
                'subscription_repeat_on' => null,
                'subscription_no' => null,
                'recur_repetitions' => 0,
                'additional_notes' => $input['additional_notes'] ?? null,
                'staff_note' => null,
                'sub_type' => null
            ];

            // Create transaction
            $invoice_total = [
                'total_before_tax' => $final_total,
                'tax' => 0
            ];

            $transaction = $this->transactionUtil->createSellTransaction(
                $business_id,
                $transaction_data,
                $invoice_total,
                $user_id,
                false
            );

            // Get the default variation for the manual product
            $variation = Variation::where('product_id', $manual_product->id)
                ->first();

            // Insert sell lines
            $products = $input['products'];
            
            foreach ($products as $product) {
                $quantity = !empty($product['quantity']) ? $product['quantity'] : 1;
                $price = !empty($product['price']) ? $product['price'] : 0;
                $product_name = !empty($product['name']) ? $product['name'] : 'Manual Product';
                
                DB::table('transaction_sell_lines')->insert([
                    'transaction_id' => $transaction->id,
                    'product_id' => $manual_product->id,
                    'variation_id' => $variation->id,
                    'quantity' => $quantity,
                    'unit_price' => $price,
                    'unit_price_inc_tax' => $price,
                    'item_tax' => 0,
                    'sell_line_note' => $product_name,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            DB::commit();

            // Return JSON response for AJAX request
            if ($request->ajax()) {
                $output = [
                    'success' => true,
                    'msg' => __('sale.sell_created_success'),
                    'redirect_url' => action([\App\Http\Controllers\SellController::class, 'index'])
                ];
                return response()->json($output);
            }

            // Regular response for non-AJAX request
            $output = ['success' => 1, 'msg' => __('sale.sell_created_success')];
            return redirect('sells')->with('status', $output);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            // Return JSON response for AJAX request
            if ($request->ajax()) {
                $output = [
                    'success' => false,
                    'msg' => __('messages.something_went_wrong') . ' ' . $e->getMessage()
                ];
                return response()->json($output);
            }
            
            // Regular response for non-AJAX request
            $output = ['success' => 0, 'msg' => __('messages.something_went_wrong')];
            return back()->with('status', $output);
        }
    }

    /**
     * Get or create a manual product for this business
     * 
     * @param int $business_id
     * @return Product
     */
    private function getOrCreateManualProduct($business_id)
    {
        // Check if a manual product already exists
        $manual_product = Product::where('business_id', $business_id)
            ->where('name', 'Manual Invoice Product')
            ->first();

        if (!empty($manual_product)) {
            return $manual_product;
        }

        // Create a new manual product
        DB::beginTransaction();
        try {
            // Get default unit
            $unit_id = DB::table('units')
                        ->where('business_id', $business_id)
                        ->where('is_default', 1)
                        ->value('id');
            
            if (empty($unit_id)) {
                $unit_id = DB::table('units')
                            ->where('business_id', $business_id)
                            ->value('id');
            }
            
            if (empty($unit_id)) {
                // Create a default unit if none exists
                $unit_id = DB::table('units')->insertGetId([
                    'business_id' => $business_id,
                    'name' => 'Pieces',
                    'short_name' => 'Pc',
                    'allow_decimal' => 0,
                    'created_by' => auth()->user()->id,
                    'is_default' => 1
                ]);
            }

            // Create the product
            $product_data = [
                'name' => 'Manual Invoice Product',
                'business_id' => $business_id,
                'type' => 'single',
                'unit_id' => $unit_id,
                'tax_type' => 'none',
                'enable_stock' => 0,
                'is_inactive' => 0,
                'created_by' => auth()->user()->id
            ];

            $manual_product = Product::create($product_data);

            // Create a product variation
            $product_variation = ProductVariation::create([
                'name' => 'DUMMY',
                'product_id' => $manual_product->id,
                'is_dummy' => 1
            ]);

            // Create a variation
            Variation::create([
                'name' => 'DUMMY',
                'product_id' => $manual_product->id,
                'product_variation_id' => $product_variation->id,
                'default_purchase_price' => 0,
                'dpp_inc_tax' => 0,
                'profit_percent' => 0,
                'default_sell_price' => 0,
                'sell_price_inc_tax' => 0
            ]);

            DB::commit();
            return $manual_product;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
