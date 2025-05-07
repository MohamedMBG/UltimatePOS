<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content bg-white rounded-lg shadow-sm p-0"> 
        <!-- Modal Header -->
        <div class="modal-header border-bottom-0 bg-white">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h2 class="modal-title text-center w-100">Create New Contact</h2>
        </div>

        @php
        $custom_labels = json_decode(session('business.custom_labels'), true);

        $contact_custom_field1 = $custom_labels['contact']['custom_field_1'] ?? __('lang_v1.contact_custom_field1');
        $contact_custom_field2 = $custom_labels['contact']['custom_field_2'] ?? __('lang_v1.contact_custom_field2');
        $contact_custom_field3 = $custom_labels['contact']['custom_field_3'] ?? __('lang_v1.contact_custom_field3');
        $contact_custom_field4 = $custom_labels['contact']['custom_field_4'] ?? __('lang_v1.contact_custom_field4');
        $contact_custom_field5 = $custom_labels['contact']['custom_field_5'] ?? __('lang_v1.contact_custom_field5');
        $contact_custom_field6 = $custom_labels['contact']['custom_field_6'] ?? __('lang_v1.contact_custom_field6');
        $contact_custom_field7 = $custom_labels['contact']['custom_field_7'] ?? __('lang_v1.contact_custom_field7');
        $contact_custom_field8 = $custom_labels['contact']['custom_field_8'] ?? __('lang_v1.custom_field', ['number' => 8]);
        $contact_custom_field9 = $custom_labels['contact']['custom_field_9'] ?? __('lang_v1.custom_field', ['number' => 9]);
        $contact_custom_field10 = $custom_labels['contact']['custom_field_10'] ?? __('lang_v1.custom_field', ['number' => 10]);
        @endphp

        {!! Form::open(['url' => route('contacts.store'), 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'contact_add_form']) !!}
            @csrf

            <!-- Basic Information Card -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-light border-bottom-0">
                    <h4 class="mb-0">Basic Information</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        {!! Form::label('type', 'Type:') !!}
                        <div class="input-group">
                            <span class="input-group-addon bg-light border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                            {!! Form::select('type', ['customer' => 'Customer', 'supplier' => 'Supplier', 'both' => 'Both'], null, ['class' => 'form-control border-left-0', 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('contact_type_radio', 'Contact Type:') !!}
                        <div class="input-group">
                            <span class="input-group-addon bg-light border-right-0">
                                <i class="fa fa-users text-muted"></i>
                            </span>
                            <div class="form-control border-left-0">
                                <label class="radio-inline mr-3">
                                    {!! Form::radio('contact_type_radio', 'individual', true) !!} Individual
                                </label>
                                <label class="radio-inline">
                                    {!! Form::radio('contact_type_radio', 'business') !!} Business
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('prefix', 'Prefix:') !!}
                        <div class="input-group">
                            <span class="input-group-addon bg-light border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                            {!! Form::text('prefix', null, ['class' => 'form-control border-left-0', 'placeholder' => 'Mr/Mrs/Dr']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('first_name', 'First Name: *') !!}
                        <div class="input-group">
                            <span class="input-group-addon bg-light border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                            {!! Form::text('first_name', null, ['class' => 'form-control border-left-0', 'required', 'placeholder' => 'First Name']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('middle_name', 'Middle Name:') !!}
                        <div class="input-group">
                            <span class="input-group-addon bg-light border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                            {!! Form::text('middle_name', null, ['class' => 'form-control border-left-0', 'placeholder' => 'Middle Name']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('last_name', 'Last Name:') !!}
                        <div class="input-group">
                            <span class="input-group-addon bg-light border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                            {!! Form::text('last_name', null, ['class' => 'form-control border-left-0', 'placeholder' => 'Last Name']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('email', 'Email:') !!}
                        <div class="input-group">
                            <span class="input-group-addon bg-light border-right-0">
                                <i class="fa fa-envelope text-muted"></i>
                            </span>
                            {!! Form::email('email', null, ['class' => 'form-control border-left-0', 'placeholder' => 'Email']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('mobile', 'Mobile: *') !!}
                        <div class="input-group">
                            <span class="input-group-addon bg-light border-right-0">
                                <i class="fa fa-mobile text-muted"></i>
                            </span>
                            {!! Form::text('mobile', null, ['class' => 'form-control border-left-0', 'required', 'placeholder' => 'Mobile Number']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('image', 'Profile Image:') !!}
                        <div class="input-group">
                            <span class="input-group-addon bg-light border-right-0">
                                <i class="fa fa-image text-muted"></i>
                            </span>
                            {!! Form::file('image', ['class' => 'form-control border-left-0', 'accept' => 'image/*']) !!}
                        </div>
                        <small class="form-text text-muted">Max file size: 2MB (JPEG, PNG, JPG, GIF)</small>
                    </div>
                </div>
            </div>

            <!-- Assigned Users Card -->
            @if(config('constants.enable_contact_assign') && isset($users) && count($users) > 0)
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-light border-bottom-0">
                    <h4 class="mb-0">Assigned Users</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        {!! Form::label('user_id', 'Assigned To:*') !!}
                        <div class="input-group">
                            <span class="input-group-addon bg-light border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                            {!! Form::select('user_id[]', $users, null, ['class' => 'form-control select2 border-left-0', 'multiple', 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('assigned_to_users', 'Additional Assigned Users:') !!}
                        <div class="input-group">
                            <span class="input-group-addon bg-light border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                            {!! Form::select('assigned_to_users[]', $users, null, ['class' => 'form-control select2 border-left-0', 'multiple']) !!}
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Contact Details Card -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-light border-bottom-0">
                    <h4 class="mb-0">Contact Details</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="tax_number"><i class="fa fa-id-card text-muted"></i> Tax Number:</label>
                        {!! Form::text('tax_number', null, ['class' => 'form-control', 'placeholder' => 'Tax number']) !!}
                    </div>
                    <div class="form-group">
                        <label for="opening_balance"><i class="fa fa-money text-muted"></i> Opening Balance:</label>
                        {!! Form::number('opening_balance', 0, ['class' => 'form-control', 'step' => '0.01']) !!}
                    </div>
                    <div class="form-group">
                        <label for="pay_term"><i class="fa fa-calendar text-muted"></i> Pay Term:</label>
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::number('pay_term_number', null, ['class' => 'form-control', 'placeholder' => 'Number']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::select('pay_term_type', ['' => 'Select Type', 'days' => 'Days', 'months' => 'Months'], null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="credit_limit"><i class="fa fa-credit-card text-muted"></i> Credit Limit:</label>
                        {!! Form::text('credit_limit', null, ['class' => 'form-control', 'placeholder' => 'Keep blank for no limit']) !!}
                    </div>
                    <div class="form-group">
                        <label for="address_line1"><i class="fa fa-map-marker text-muted"></i> Address Line 1:</label>
                        {!! Form::text('address_line1', null, ['class' => 'form-control', 'placeholder' => 'Address line 1']) !!}
                    </div>
                    <div class="form-group">
                        <label for="address_line2"><i class="fa fa-map-marker text-muted"></i> Address Line 2:</label>
                        {!! Form::text('address_line2', null, ['class' => 'form-control', 'placeholder' => 'Address line 2']) !!}
                    </div>
                    <div class="form-group">
                        <label for="city"><i class="fa fa-map-marker text-muted"></i> City:</label>
                        {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'City']) !!}
                    </div>
                    <div class="form-group">
                        <label for="state"><i class="fa fa-map-marker text-muted"></i> State:</label>
                        {!! Form::text('state', null, ['class' => 'form-control', 'placeholder' => 'State']) !!}
                    </div>
                    <div class="form-group">
                        <label for="country"><i class="fa fa-map-marker text-muted"></i> Country:</label>
                        {!! Form::text('country', null, ['class' => 'form-control', 'placeholder' => 'Country']) !!}
                    </div>
                    <div class="form-group">
                        <label for="zip_code"><i class="fa fa-map-marker text-muted"></i> ZIP Code:</label>
                        {!! Form::text('zip_code', null, ['class' => 'form-control', 'placeholder' => 'ZIP/Postal Code']) !!}
                    </div>
                </div>
            </div>

            <!-- Custom Fields Card -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-light border-bottom-0">
                    <h4 class="mb-0">Custom Fields</h4>
                </div>
                <div class="card-body">
                    <div class="container mt-4">
                        <table class="table table-bordered text-center align-middle table-hover shadow-sm">
                            <tbody>
                                <tr class="table-primary">
                                    <td rowspan="2" class="fw-bold align-middle">E.P</td>
                                    <td><strong>OD:</strong> {!! Form::text('custom_field1', null, ['class' => 'form-control form-control-sm w-75 d-inline']) !!}</td>
                                    <td><strong>OG:</strong> {!! Form::text('custom_field2', null, ['class' => 'form-control form-control-sm w-75 d-inline']) !!}</td>
                                    <td rowspan="2" class="fw-bold align-middle">H.P</td>
                                    <td><strong>OD:</strong> {!! Form::text('custom_field3', null, ['class' => 'form-control form-control-sm w-75 d-inline']) !!}</td>
                                    <td><strong>OG:</strong> {!! Form::text('custom_field4', null, ['class' => 'form-control form-control-sm w-75 d-inline']) !!}</td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <table class="table table-bordered text-center align-middle table-hover shadow-sm">
                            <tbody>
                                <tr class="table-success">
                                    <td rowspan="2" class="fw-bold align-middle">V.L</td>
                                    <td><strong>OD:</strong> {!! Form::text('custom_field5', null, ['class' => 'form-control form-control-sm w-75 d-inline']) !!}</td>
                                </tr>
                                <tr>
                                    <td><strong>OG:</strong> {!! Form::text('custom_field6', null, ['class' => 'form-control form-control-sm w-75 d-inline']) !!}</td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <table class="table table-bordered text-center align-middle table-hover shadow-sm">
                            <tbody>
                                <tr class="table-warning">
                                    <td rowspan="2" class="fw-bold align-middle">V.P</td>
                                    <td><strong>OD:</strong> {!! Form::text('custom_field7', null, ['class' => 'form-control form-control-sm w-75 d-inline']) !!}</td>
                                </tr>
                                <tr>
                                    <td><strong>OG:</strong> {!! Form::text('custom_field8', null, ['class' => 'form-control form-control-sm w-75 d-inline']) !!}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="d-flex justify-content-between mt-4 mb-3">
                <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm">
                    <i class="fa fa-save"></i> Save Contact
                </button>
                <button type="button" class="btn btn-danger px-4 py-2 shadow-sm" data-dismiss="modal">
                    <i class="fa fa-times"></i> Cancel
                </button>
            </div>
        {!! Form::close() !!}
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script>
    $(document).ready(function() {
        // Initialize select2
        $('.select2').select2({
            width: '100%'
        });

        // Form validation
        $('#contact_add_form').validate({
            rules: {
                first_name: "required",
                type: "required",
                mobile: "required",
                'user_id[]': "required",
                image: {
                    extension: "jpg|jpeg|png|gif",
                    filesize: 2000000 // 2MB
                }
            },
            messages: {
                image: {
                    extension: "Please upload valid image file (jpg, jpeg, png, gif)",
                    filesize: "File size must be less than 2MB"
                }
            }
        });
    });
</script>