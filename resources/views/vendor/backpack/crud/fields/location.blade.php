<!-- text input -->

<?php

// the field should work whether or not Laravel attribute casting is used
if (isset($field['value']) && (is_array($field['value']) || is_object($field['value']))) {
    $field['value'] = json_encode($field['value']);
}

?>

<div @include('crud::inc.field_wrapper_attributes') >
    <label>{!! $field['label'] !!}</label>
    @include('crud::inc.field_translatable_icon')




    <div class="input-group">
        <input type="text" name="{{ $field['name'] }}" id="txtPlaces" class="form-control" placeholder="Enter a location"  @include('crud::inc.field_attributes') value="{{ old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' )) }}" />
        <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
    </div>
    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>

{{-- Note: you can use  to only load some CSS/JS once, even though there are multiple instances of it --}}

{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))

    {{-- FIELD CSS - will be loaded in the after_styles section --}}
    @push('crud_fields_styles')
       
    @endpush

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
       <script type="text/javascript">
           $('form').on('keyup keypress', function(e) {
              var keyCode = e.keyCode || e.which;
              if (keyCode === 13) { 
                e.preventDefault();
                return false;
              }
            });
       </script>     
       <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABIlUStLsr84EGUomykEKJeNPIuWbT854&v=3.exp&sensor=false&libraries=places"></script>
        
        <script type="text/javascript">
            google.maps.event.addDomListener(window, 'load', function () {
                var places = new google.maps.places.Autocomplete(document.getElementById('txtPlaces'));
                google.maps.event.addListener(places, 'place_changed', function () {

                });
            });
        </script>
    @endpush

@endif
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
