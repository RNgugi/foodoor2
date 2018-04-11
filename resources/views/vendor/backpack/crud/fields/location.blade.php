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

    <div class="" style="width: 550px">
        <div class="form-group" style="padding-top: 10px;">
         

          
                <input type="text" name="{{ $field['name'] }}"  class="form-control" placeholder="Enter a location"  @include('crud::inc.field_attributes') value="{{ old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' )) }}"  id="us3-address" />
          
        </div>
     
       
            
        <div id="us3" style="width: 550px; height: 400px;"></div>
        
       
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

           <script src="/js/locationpicker.jquery.js"></script>
        
        <script>
            $('#us3').locationpicker({
                location: {
                    latitude: {{ isset($crud->entry->latitude) ? $crud->entry->latitude : 23.344036  }} ,
                    longitude: {{ isset($crud->entry->latitude) ? $crud->entry->longitude : 85.301583  }} 
                },
                radius: 0,
                inputBinding: {
                    latitudeInput: $('#latitude'),
                    longitudeInput: $('#longitude'),
                    locationNameInput: $('#us3-address')
                },
                enableAutocomplete: true,
                onchanged: function (currentLocation, radius, isMarkerDropped) {
                    // Uncomment line below to show alert on each Location Changed event
                    //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
                }
            });
        </script>
    @endpush

@endif
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
