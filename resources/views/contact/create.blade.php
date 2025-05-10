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
            <div class="modal-body">
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
            <style>
    .form-control-sm {
        height: 32px;
        font-size: 0.8rem;
        padding: 0.25rem 0.4rem;
        border-radius: 0.3rem;
    }

    .badge {
        font-size: 0.75rem;
        padding: 0.35em 0.65em;
        font-weight: 600;
        border-radius: 0.375rem;
    }

    .small.text-muted {
        font-size: 0.75rem;
    }

    label.small {
        font-size: 0.75rem;
        margin-bottom: 0.25rem;
        display: block;
    }

    .custom-section {
        border: 1px solid #e0e0e0;
        border-radius: 0.5rem;
        padding: 1rem;
        background-color: #ffffff;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        transition: box-shadow 0.2s ease;
    }

    .custom-section:hover {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .custom-label {
        margin-bottom: 0.4rem;
        font-weight: 500;
    }
</style>

<div class="card mb-4 border-0 shadow-sm">
    <div class="card-header bg-light border-bottom-0 py-2">
        <h5 class="mb-0">Custom Fields</h5>
    </div>
    <div class="card-body p-4">
        <div class="container-fluid px-0">

            <!-- Row 1: V.L + EP -->
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <div class="custom-section h-100">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-info me-2">V.L</span>
                        </div>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="small text-muted custom-label">OD</label>
                                {!! Form::text('custom_field1', null, ['class' => 'form-control form-control-sm']) !!}
                            </div>
                            <div class="col-6">
                                <label class="small text-muted custom-label">OG</label>
                                {!! Form::text('custom_field2', null, ['class' => 'form-control form-control-sm']) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="custom-section h-100">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-info me-2">EP</span>
                        </div>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="small text-muted custom-label">EPD</label>
                                {!! Form::text('custom_field6', null, ['class' => 'form-control form-control-sm']) !!}
                            </div>
                            <div class="col-6">
                                <label class="small text-muted custom-label">EPG</label>
                                {!! Form::text('custom_field7', null, ['class' => 'form-control form-control-sm']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 2: ADD (centered and small) -->
            <div class="row g-4 mb-5 justify-content-center">
                <div class="col-md-6">
                    <div class="custom-section">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-info me-2">ADD</span>
                        </div>
                        {!! Form::text('custom_field3', null, ['class' => 'form-control form-control-sm']) !!}
                    </div>
                </div>
            </div>

            <!-- Row 3: V.P (centered and small) -->
            <div class="row g-4 justify-content-center">
                <div class="col-md-6">
                    <div class="custom-section">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-info me-2">V.P</span>
                        </div>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="small text-muted custom-label">OD</label>
                                {!! Form::text('custom_field4', null, ['class' => 'form-control form-control-sm']) !!}
                            </div>
                            <div class="col-6">
                                <label class="small text-muted custom-label">OG</label>
                                {!! Form::text('custom_field5', null, ['class' => 'form-control form-control-sm']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
        </div>
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

<style>
    /* Ensure the modal content takes the full height */
.modal-content {
    height: 100%;
    display: flex;
    flex-direction: column;
    overflow-x: hidden;
}

/* Make sure modal body takes the remaining space */
.modal-body {
    flex-grow: 1;
    overflow-y: auto;
}

/* Optional: Add padding inside the modal body for spacing */
.modal-body .card {
    margin-bottom: 1rem;
}

.modal-lg {
  max-width: 70%;
  width: 100%;
}

/* Compact form controls */
.form-control-sm {
    height: calc(1.5em + 0.5rem + 2px);
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    line-height: 1.5;
    border-radius: 0.2rem;
}

.card-header.py-1 {
    padding-top: 0.25rem !important;
    padding-bottom: 0.25rem !important;
}

.card-body.p-2 {
    padding: 0.5rem !important;
}
</style>