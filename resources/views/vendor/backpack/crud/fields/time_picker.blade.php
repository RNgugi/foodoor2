<!-- bootstrap datetimepicker input -->

<?php
// if the column has been cast to Carbon or Date (using attribute casting)
// get the value as a date string
if (isset($field['value']) && ( $field['value'] instanceof \Carbon\Carbon || $field['value'] instanceof \Jenssegers\Date\Date )) {
    $field['value'] = $field['value']->format('Y-m-d H:i:s');
}

    $field_language = isset($field['datetime_picker_options']['language'])?$field['datetime_picker_options']['language']:\App::getLocale();
?>

<div @include('crud::inc.field_wrapper_attributes') >
    
    <label>{!! $field['label'] !!}</label>
    
    @include('crud::inc.field_translatable_icon')
    
    <div class="input-group date">
        <input
            type="text"
            class="form-control timepicker"
            name="{{ $field['name'] }}"
            value="{{ old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' )) }}"
            @include('crud::inc.field_attributes')
            >
        <div class="input-group-addon">
            <span class="fa fa-clock"></span>
        </div>
    </div>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>

{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))

    {{-- FIELD CSS - will be loaded in the after_styles section --}}
    @push('crud_fields_styles')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    @endpush

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
    <script type="text/javascript" src="{{ asset('vendor/adminlte/bower_components/moment/moment.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    @if ($field_language !== 'en')
        <script charset="UTF-8" src="{{ asset('vendor/adminlte/bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.'.$field_language.'.js') }}"></script>
        <script charset="UTF-8" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/locale/{{$field_language}}.js"></script>
    @endif
    <script>
        

        jQuery(document).ready(function($){
           $('.timepicker').timepicker({
            timeFormat: 'h:mm p',
        });
        });
    </script>
    @endpush

@endif
{{-- End of Extra CSS and JS --}}
