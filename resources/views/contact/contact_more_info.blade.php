@php
    $custom_labels = json_decode(session('business.custom_labels'), true);
@endphp

@if(!empty($contact->custom_field1) || !empty($contact->custom_field2))
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>V.L</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($contact->custom_field1))
                <tr>
                    <td><strong>{{ $custom_labels['contact']['custom_field_1'] ?? __('lang_v1.contact_custom_field1') }}</strong></td>
                    <td>{{ $contact->custom_field1 }}</td>
                </tr>
            @endif
            @if(!empty($contact->custom_field2))
                <tr>
                    <td><strong>{{ $custom_labels['contact']['custom_field_2'] ?? __('lang_v1.contact_custom_field2') }}</strong></td>
                    <td>{{ $contact->custom_field2 }}</td>
                </tr>
            @endif
        </tbody>
    </table>
@endif

@if(!empty($contact->custom_field3) || !empty($contact->custom_field4))
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>V.P</th>
                <th></th>
            </tr>
        </thead>
        
        <tbody>
            @if(!empty($contact->custom_field3))
                <tr>
                    <td><strong>{{ $custom_labels['contact']['custom_field_3'] ?? __('lang_v1.contact_custom_field3') }}</strong></td>
                    <td>{{ $contact->custom_field3 }}</td>
                </tr>
            @endif
            @if(!empty($contact->custom_field4))
                <tr>
                    <td><strong>{{ $custom_labels['contact']['custom_field_4'] ?? __('lang_v1.contact_custom_field4') }}</strong></td>
                    <td>{{ $contact->custom_field4 }}</td>
                </tr>
            @endif
        </tbody>
    </table>
@endif

@if(!empty($contact->custom_field5) || !empty($contact->custom_field6))
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>E.P</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($contact->custom_field5))
                <tr>
                    <td><strong>{{ $custom_labels['contact']['custom_field_5'] ?? __('lang_v1.contact_custom_field5') }}</strong></td>
                    <td>{{ $contact->custom_field5 }}</td>
                </tr>
            @endif
            @if(!empty($contact->custom_field6))
                <tr>
                    <td><strong>{{ $custom_labels['contact']['custom_field_6'] ?? __('lang_v1.contact_custom_field6') }}</strong></td>
                    <td>{{ $contact->custom_field6 }}</td>
                </tr>
            @endif
        </tbody>
    </table>
@endif

@if(!empty($contact->custom_field7) || !empty($contact->custom_field8))
    <table class="table table-bordered">
    <thead>
            <tr>
                <th>H.P</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($contact->custom_field7))
                <tr>
                    <td><strong>{{ $custom_labels['contact']['custom_field_7'] ?? __('lang_v1.contact_custom_field7') }}</strong></td>
                    <td>{{ $contact->custom_field7 }}</td>
                </tr>
            @endif
            @if(!empty($contact->custom_field8))
                <tr>
                    <td><strong>{{ $custom_labels['contact']['custom_field_8'] ?? __('lang_v1.custom_field', ['number' => 8]) }}</strong></td>
                    <td>{{ $contact->custom_field8 }}</td>
                </tr>
            @endif
        </tbody>
    </table>
@endif

@if(!empty($contact->custom_field9) || !empty($contact->custom_field10))
    <table class="table table-bordered">
        <tbody>
            @if(!empty($contact->custom_field9))
                <tr>
                    <td><strong>{{ $custom_labels['contact']['custom_field_9'] ?? __('lang_v1.custom_field', ['number' => 9]) }}</strong></td>
                    <td>{{ $contact->custom_field9 }}</td>
                </tr>
            @endif
            @if(!empty($contact->custom_field10))
                <tr>
                    <td><strong>{{ $custom_labels['contact']['custom_field_10'] ?? __('lang_v1.custom_field', ['number' => 10]) }}</strong></td>
                    <td>{{ $contact->custom_field10 }}</td>
                </tr>
            @endif
        </tbody>
    </table>
@endif