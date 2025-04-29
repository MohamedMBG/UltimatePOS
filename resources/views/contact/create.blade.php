<!-- business information here -->

<div class="row" style="color: #000000 !important;">
	<!-- Logo -->
	@if(empty($receipt_details->letter_head))
	@if(!empty($receipt_details->logo))
	<img style="max-height: 120px; width: auto;" src="{{$receipt_details->logo}}" class="img img-responsive center-block">
	@endif

	<!-- Header text -->
	@if(!empty($receipt_details->header_text))
	<div class="col-xs-12">
		{!! $receipt_details->header_text !!}
	</div>
	@endif

	<!-- business information here -->
	<div class="col-xs-12 text-center">
		<h2 class="text-center">
			<!-- Shop & Location Name  -->
			@if(!empty($receipt_details->display_name))
			{{$receipt_details->display_name}}
			@endif
		</h2>

		<!-- Address -->
		<p>
			@if(!empty($receipt_details->address))
			<small class="text-center">
				{!! $receipt_details->address !!}
			</small>
			@endif
			@if(!empty($receipt_details->contact))
			<br />{!! $receipt_details->contact !!}
			@endif
			@if(!empty($receipt_details->contact) && !empty($receipt_details->website))
			,
			@endif
			@if(!empty($receipt_details->website))
			{{ $receipt_details->website }}
			@endif
			@if(!empty($receipt_details->location_custom_fields))
			<br>{{ $receipt_details->location_custom_fields }}
			@endif
		</p>
		<p>
			@if(!empty($receipt_details->sub_heading_line1))
			{{ $receipt_details->sub_heading_line1 }}
			@endif
			@if(!empty($receipt_details->sub_heading_line2))
			<br>{{ $receipt_details->sub_heading_line2 }}
			@endif
			@if(!empty($receipt_details->sub_heading_line3))
			<br>{{ $receipt_details->sub_heading_line3 }}
			@endif
			@if(!empty($receipt_details->sub_heading_line4))
			<br>{{ $receipt_details->sub_heading_line4 }}
			@endif
			@if(!empty($receipt_details->sub_heading_line5))
			<br>{{ $receipt_details->sub_heading_line5 }}
			@endif
		</p>
		<p>
			@if(!empty($receipt_details->tax_info1))
			<b>{{ $receipt_details->tax_label1 }}</b> {{ $receipt_details->tax_info1 }}
			@endif

			@if(!empty($receipt_details->tax_info2))
			<b>{{ $receipt_details->tax_label2 }}</b> {{ $receipt_details->tax_info2 }}
			@endif
		</p>
		@endif


		<!-- Title of receipt -->
		@if(!empty($receipt_details->invoice_heading))
		<h3 class="text-center">
			{!! $receipt_details->invoice_heading !!}
		</h3>
		@endif
	</div>
	@if(!empty($receipt_details->letter_head))
	<div class="col-xs-12 text-center">
		<img style="width: 100%;margin-bottom: 10px;" src="{{$receipt_details->letter_head}}">
	</div>
	@endif
	<div class="col-xs-12 text-center">
		<!-- Invoice  number, Date  -->
		<p style="width: 100% !important" class="word-wrap">
			<span class="pull-left text-left word-wrap">
				@if(!empty($receipt_details->invoice_no_prefix))
				<b>{!! $receipt_details->invoice_no_prefix !!}</b>
				@endif
				{{$receipt_details->invoice_no}}

				@if(!empty($receipt_details->types_of_service))
				<br />
				<span class="pull-left text-left">
					<strong>{!! $receipt_details->types_of_service_label !!}:</strong>
					{{$receipt_details->types_of_service}}
					<!-- Waiter info -->
					@if(!empty($receipt_details->types_of_service_custom_fields))
					@foreach($receipt_details->types_of_service_custom_fields as $key => $value)
					<br><strong>{{$key}}: </strong> {{$value}}
					@endforeach
					@endif
				</span>
				@endif

				<!-- Table information-->
				@if(!empty($receipt_details->table_label) || !empty($receipt_details->table))
				<br />
				<span class="pull-left text-left">
					@if(!empty($receipt_details->table_label))
					<b>{!! $receipt_details->table_label !!}</b>
					@endif
					{{$receipt_details->table}}

					<!-- Waiter info -->
				</span>
				@endif

				<!-- customer info -->
				@if(!empty($receipt_details->customer_info))
				<br />
				<b>{{ $receipt_details->customer_label }}</b> <br> {!! $receipt_details->customer_info !!} <br>
				@endif
				@if(!empty($receipt_details->client_id_label))
				<br />
				<b>{{ $receipt_details->client_id_label }}</b> {{ $receipt_details->client_id }}
				@endif
				@if(!empty($receipt_details->customer_tax_label))
				<br />
				<b>{{ $receipt_details->customer_tax_label }}</b> {{ $receipt_details->customer_tax_number }}
				@endif
				<!--
				@if(!empty($receipt_details->customer_custom_fields))
					<br/>{!! $receipt_details->customer_custom_fields !!}
				@endif
				-->
				@if(!empty($receipt_details->custom_field1) || !empty($receipt_details->custom_field2) || !empty($receipt_details->custom_field3) || !empty($receipt_details->custom_field4) || !empty($receipt_details->custom_field5) || !empty($receipt_details->custom_field6) || !empty($receipt_details->custom_field7))
                <br/>
                <br/><br/>
                <h3 style="text-align: center; font-weight: bold; margin-bottom: 20px;">Mesures</h3>

                <div style="margin-top: 20px; margin-bottom: 20px;">
                    <!-- V.P and E.P Row -->
                    <div style="display: flex; width: 100%; margin-bottom: 10px;">
                        <!-- V.P Table -->
                        <div style="width: 50%; padding-right: 10px;">
                            @if(!empty($receipt_details->custom_field1) || !empty($receipt_details->custom_field2))
                            <table style="width: 100%; border-collapse: collapse; border: 1px solid #ddd;">
                                <tr>
                                    <td style="border: 1px solid #ddd; padding: 8px; text-align: center; width: 30%;">V.P</td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">
                                        <div><strong>OD:</strong> {{ $receipt_details->custom_field1 ?? '' }}</div>
                                        <div style="margin-top: 8px;"><strong>OG:</strong> {{ $receipt_details->custom_field2 ?? '' }}</div>
                                    </td>
                                </tr>
                            </table>
                            @endif
                        </div>
                        
                        <!-- E.P Table -->
                        <div style="width: 50%; padding-left: 10px;">
                            @if(!empty($receipt_details->custom_field6) || !empty($receipt_details->custom_field7))
                            <table style="width: 100%; border-collapse: collapse; border: 1px solid #ddd;">
                                <tr>
                                    <td style="border: 1px solid #ddd; padding: 8px; text-align: center; width: 25%;">E.Pd</td>
                                    <td style="border: 1px solid #ddd; padding: 8px; text-align: center; width: 25%;">{{ $receipt_details->custom_field6 ?? '' }}</td>
                                    <td style="border: 1px solid #ddd; padding: 8px; text-align: center; width: 25%;">E.Pg</td>
                                    <td style="border: 1px solid #ddd; padding: 8px; text-align: center; width: 25%;">{{ $receipt_details->custom_field7 ?? '' }}</td>
                                </tr>
                            </table>
                            @endif
                        </div>
                    </div>
                    
                    <!-- ADD Row -->
                    <div style="width: 50%; margin-bottom: 10px;">
                        @if(!empty($receipt_details->custom_field3))
                        <table style="width: 100%; border-collapse: collapse; border: 1px solid #ddd;">
                            <tr>
                                <td style="border: 1px solid #ddd; padding: 8px; text-align: center; width: 30%;">ADD</td>
                                <td style="border: 1px solid #ddd; padding: 8px;">{{ $receipt_details->custom_field3 ?? '' }}</td>
                            </tr>
                        </table>
                        @endif
                    </div>
                    
                    <!-- V.L Row -->
                    <div style="width: 50%; margin-bottom: 10px;">
                        @if(!empty($receipt_details->custom_field4) || !empty($receipt_details->custom_field5))
                        <table style="width: 100%; border-collapse: collapse; border: 1px solid #ddd;">
                            <tr>
                                <td style="border: 1px solid #ddd; padding: 8px; text-align: center; width: 30%;">V.L</td>
                                <td style="border: 1px solid #ddd; padding: 8px;">
                                    <div><strong>OD:</strong> {{ $receipt_details->custom_field4 ?? '' }}</div>
                                    <div style="margin-top: 8px;"><strong>OG:</strong> {{ $receipt_details->custom_field5 ?? '' }}</div>
                                </td>
                            </tr>
                        </table>
                        @endif
                    </div>
                </div>
                @endif
				@if(!empty($receipt_details->sales_person_label))
				<br />
				<b>{{ $receipt_details->sales_person_label }}</b> {{ $receipt_details->sales_person }}
				@endif
				@if(!empty($receipt_details->commission_agent_label))
				<br />
				<strong>{{ $receipt_details->commission_agent_label }}</strong> {{ $receipt_details->commission_agent }}
				@endif
				@if(!empty($receipt_details->customer_rp_label))
				<br />
				<strong>{{ $receipt_details->customer_rp_label }}</strong> {{ $receipt_details->customer_total_rp }}
				@endif
			</span>

			<span class="pull-right text-left">
				<b>{{$receipt_details->date_label}}</b> {{$receipt_details->invoice_date}}

				@if(!empty($receipt_details->due_date_label))
				<br><b>{{$receipt_details->due_date_label}}</b> {{$receipt_details->due_date ?? ''}}
				@endif

				@if(!empty($receipt_details->brand_label) || !empty($receipt_details->repair_brand))
				<br>
				@if(!empty($receipt_details->brand_label))
				<b>{!! $receipt_details->brand_label !!}</b>
				@endif
				{{$receipt_details->repair_brand}}
				@endif


				@if(!empty($receipt_details->device_label) || !empty($receipt_details->repair_device))
				<br>
				@if(!empty($receipt_details->device_label))
				<b>{!! $receipt_details->device_label !!}</b>
				@endif
				{{$receipt_details->repair_device}}
				@endif

				@if(!empty($receipt_details->model_no_label) || !empty($receipt_details->repair_model_no))
				<br>
				@if(!empty($receipt_details->model_no_label))
				<b>{!! $receipt_details->model_no_label !!}</b>
				@endif
				{{$receipt_details->repair_model_no}}
				@endif

				@if(!empty($receipt_details->serial_no_label) || !empty($receipt_details->repair_serial_no))
				<br>
				@if(!empty($receipt_details->serial_no_label))
				<b>{!! $receipt_details->serial_no_label !!}</b>
				@endif
				{{$receipt_details->repair_serial_no}}<br>
				@endif
				@if(!empty($receipt_details->repair_status_label) || !empty($receipt_details->repair_status))
				@if(!empty($receipt_details->repair_status_label))
				<b>{!! $receipt_details->repair_status_label !!}</b>
				@endif
				{{$receipt_details->repair_status}}<br>
				@endif

				@if(!empty($receipt_details->repair_warranty_label) || !empty($receipt_details->repair_warranty))
				@if(!empty($receipt_details->repair_warranty_label))
				<b>{!! $receipt_details->repair_warranty_label !!}</b>
				@endif
				{{$receipt_details->repair_warranty}}
				<br>
				@endif

				<!-- Waiter info -->
				@if(!empty($receipt_details->service_staff_label) || !empty($receipt_details->service_staff))
				<br />
				@if(!empty($receipt_details->service_staff_label))
				<b>{!! $receipt_details->service_staff_label !!}</b>
				@endif
				{{$receipt_details->service_staff}}
				@endif
				@if(!empty($receipt_details->shipping_custom_field_1_label))
				<br><strong>{!!$receipt_details->shipping_custom_field_1_label!!} :</strong> {!!$receipt_details->shipping_custom_field_1_value ?? ''!!}
				@endif

				@if(!empty($receipt_details->shipping_custom_field_2_label))
				<br><strong>{!!$receipt_details->shipping_custom_field_2_label!!}:</strong> {!!$receipt_details->shipping_custom_field_2_value ?? ''!!}
				@endif

				@if(!empty($receipt_details->shipping_custom_field_3_label))
				<br><strong>{!!$receipt_details->shipping_custom_field_3_label!!}:</strong> {!!$receipt_details->shipping_custom_field_3_value ?? ''!!}
				@endif

				@if(!empty($receipt_details->shipping_custom_field_4_label))
				<br><strong>{!!$receipt_details->shipping_custom_field_4_label!!}:</strong> {!!$receipt_details->shipping_custom_field_4_value ?? ''!!}
				@endif

				@if(!empty($receipt_details->shipping_custom_field_5_label))
				<br><strong>{!!$receipt_details->shipping_custom_field_2_label!!}:</strong> {!!$receipt_details->shipping_custom_field_5_value ?? ''!!}
				@endif
				{{-- sale order --}}
				@if(!empty($receipt_details->sale_orders_invoice_no))
				<br>
				<strong>@lang('restaurant.order_no'):</strong> {!!$receipt_details->sale_orders_invoice_no ?? ''!!}
				@endif

				@if(!empty($receipt_details->sale_orders_invoice_date))
				<br>
				<strong>@lang('lang_v1.order_dates'):</strong> {!!$receipt_details->sale_orders_invoice_date ?? ''!!}
				@endif

				@if(!empty($receipt_details->sell_custom_field_1_value))
				<br>
				<strong>{{ $receipt_details->sell_custom_field_1_label }}:</strong> {!!$receipt_details->sell_custom_field_1_value ?? ''!!}
				@endif

				@if(!empty($receipt_details->sell_custom_field_2_value))
				<br>
				<strong>{{ $receipt_details->sell_custom_field_2_label }}:</strong> {!!$receipt_details->sell_custom_field_2_value ?? ''!!}
				@endif

				@if(!empty($receipt_details->sell_custom_field_3_value))
				<br>
				<strong>{{ $receipt_details->sell_custom_field_3_label }}:</strong> {!!$receipt_details->sell_custom_field_3_value ?? ''!!}
				@endif

				@if(!empty($receipt_details->sell_custom_field_4_value))
				<br>
				<strong>{{ $receipt_details->sell_custom_field_4_label }}:</strong> {!!$receipt_details->sell_custom_field_4_value ?? ''!!}
				@endif

			</span>
		</p>
	</div>
</div>
