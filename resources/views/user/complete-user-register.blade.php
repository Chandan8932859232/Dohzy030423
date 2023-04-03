@extends('layouts.user')

@section('title', 'Complete Profile')

@section('content')

    <div class="row">
        <div class="col-sm-8">

            <h3 class="text-center mt-3 form_title">{{__('complete your profile')}}</h3>
            <hr>
            <div class="container">

            <form action="{{ route('process.complete') }}" method="POST">
                @csrf
                <div class="form-row">


                    <div class="form-group col-md-6 mt-3">
                        <label class="form_text">{{__('birth year')}}</label>
                        <select id="inputState"  name="birthYear"  class="form-control {{ $errors->has('birthYear') ? ' is-invalid' : '' }}">
                            <option value="">{{__('select year')}}</option>
                            @for ($i=2005; $i>1930; $i--)
                                <option value={{$i}} {{ old('birthYear')==$i ?'selected':''}}>{{$i}}</option>
                            @endfor
                        </select>
                        @if($errors->has('birthYear'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('birthYear') }}</strong>
                            </span>
                        @endif
                    </div>

                    {{--
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">{{__('ethnicity')}}</label>
                        <select id="inputState"  name="ethnicity"  class="form-control {{ $errors->has('ethnicity') ? ' is-invalid' : '' }}">
                            <option value="">{{__('choose ethnicity')}}</option>
                            <option value="b" {{ old('ethnicity')=="b" ?'selected':''}}>{{__('black')}}</option>
                            <option value="c" {{ old('ethnicity')=="c" ?'selected':''}}>{{__('caucasian')}}</option>
                            <option value="d" {{ old('ethnicity')=="d" ?'selected':''}}>{{__('hispanic')}}</option>
                            <option value="a" {{ old('ethnicity')=="a" ?'selected':''}}>{{__('asian')}}</option>
                            <option value="o" {{ old('ethnicity')=="o" ?'selected':''}}>{{__('other')}}</option>
                        </select>

                        @if ($errors->has('ethnicity'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('ethnicity') }}</strong>
                           </span>
                        @endif
                    </div> --}}


                    <div class="form-group col-md-6 mt-3">
                        <label>{{__('in what industry do you work')}}</label>

                        <select id="inputState"  name="workIndustry"  class="form-control {{ $errors->has('workIndustry') ? ' is-invalid' : '' }}">
                            <option value="">{{__('choose work industry')}}</option>
                            <option value="1" {{ old('workIndustry')=="1" ?'selected':''}}>{{__('i am not employed')}}</option>
                            <option value="2" {{ old('workIndustry')=="2" ?'selected':''}}>{{__('full time student')}}</option>
                            <option value="3" {{ old('workIndustry')=="3" ?'selected':''}}>{{__('health care')}}</option>
                            <option value="4" {{ old('workIndustry')=="4" ?'selected':''}}>{{__('educational services')}}</option>
                            <option value="5" {{ old('workIndustry')=="5" ?'selected':''}}>{{__('finance')}}</option>
                            <option value="6" {{ old('workIndustry')=="6" ?'selected':''}}>{{__('government')}}</option>
                            <option value="7" {{ old('workIndustry')=="7" ?'selected':''}}>{{__('information technology')}}</option>
                            <option value="8" {{ old('workIndustry')=="8" ?'selected':''}}>{{__('agriculture')}}</option>
                            <option value="9" {{ old('workIndustry')=="9" ?'selected':''}}>{{__('entertainment, arts')}}</option>
                            <option value="10" {{ old('workIndustry')=="10" ?'selected':''}}>{{__('construction')}}</option>
                            <option value="11" {{ old('workIndustry')=="11" ?'selected':''}}>{{__('real estate')}}</option>
                            <option value="12" {{ old('workIndustry')=="12" ?'selected':''}}>{{__('Transport')}}</option>
                            <option value="13" {{ old('workIndustry')=="13" ?'selected':''}}>{{__('retail')}}</option>
                            <option value="14" {{ old('workIndustry')=="14" ?'selected':''}}>{{__('mining')}}</option>
                            <option value="15" {{ old('workIndustry')=="15" ?'selected':''}}>{{__('other')}}</option>
                        </select>

                        @if ($errors->has('workIndustry'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('workIndustry') }}</strong>
                           </span>
                        @endif
                    </div>




                    <div class="form-group col-md-6 mt-3">
                        <label>{{__('how long have you been in canada')}}</label>

                        <select id="inputState"  name="yearsInCanada"  class="form-control {{ $errors->has('yearsInCanada') ? ' is-invalid' : '' }}">
                            <option value="">{{__('choose time in canada')}}</option>
                            <option value="1" {{ old('yearsInCanada')=="1" ?'selected':''}}>{{__('less than 1 year')}}</option>
                            <option value="2" {{ old('yearsInCanada')=="2" ?'selected':''}}>{{__('1 to 2 years')}}</option>
                            <option value="3" {{ old('yearsInCanada')=="3" ?'selected':''}}>{{__('3 to 4 years')}}</option>
                            <option value="4" {{ old('yearsInCanada')=="4" ?'selected':''}}>{{__('5 to 7 years')}}</option>
                            <option value="5" {{ old('yearsInCanada')=="5" ?'selected':''}}>{{__('8 to 9 years')}}</option>
                            <option value="6" {{ old('yearsInCanada')=="6" ?'selected':''}}>{{__('more than 10 years')}}</option>
                            <option value="0" {{ old('yearsInCanada')=="0" ?'selected':''}}>{{__('i was born in canada')}}</option>
                            <option value="7" {{ old('yearsInCanada')=="7" ?'selected':''}}>{{__('i am not in canada')}}</option>
                        </select>

                        @if ($errors->has('yearsInCanada'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('yearsInCanada') }}</strong>
                           </span>
                        @endif
                    </div>




                    <div class="form-group col-md-6 mt-3">
                        <label class="form_text">{{__('what is your marital status')}}</label>
                        <select id="inputState"  name="maritalStatus"  class="form-control {{ $errors->has('maritalStatus') ? ' is-invalid' : '' }}">
                            <option value="" selected>{{__('choose marital status')}}</option>
                            <option value="0" {{ old('maritalStatus')=="0" ?'selected':''}} >{{__('not married')}}</option>
                            <option value="1" {{ old('maritalStatus')=="1" ?'selected':''}} >{{__('married')}}</option>
                        </select>

                        @if ($errors->has('maritalStatus'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('maritalStatus') }}</strong>
                            </span>
                        @endif
                    </div>



                    <div class="form-group col-md-6 mt-3">
                        <label class="form_text">{{__('country of origin')}}</label>
                        <select id="inputState"  name="countryOfOrigin"  class="form-control {{ $errors->has('countryOfOrigin') ? ' is-invalid' : '' }}">
                            <option value="">{{__('choose country of origin')}}</option>

                            @foreach($countryInfo as $code=> $country)

                              <option value={{$code}} {{ old('countryOfOrigin')==$code ?'selected':''}}>{{ucwords(strtolower($country['name']))}}</option>

                            @endforeach

                        </select>
                        <small><i class="fas fa-info-circle"></i> {{__('if born in canada or not')}}</small>

                        @if ($errors->has('countryOfOrigin'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('countryOfOrigin') }}</strong>
                           </span>
                        @endif
                    </div>


                {{-- </div>  --}}

                <div class="form-group col-md-6 mt-3" id="locationField">
                    <label class="form_text">{{__('address')}}</label>
                    <input type="text"  id="autocomplete" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}"
                           name="address"  value="{{ old('address') }}"
                           placeholder="{{__('enter your residential address')}}">
                    @if($errors->has('address'))
                        <span class="invalid-feedback" role="alert">
                         <strong>{{ $errors->first('address') }}</strong>
                       </span>
                    @endif
                </div>


                <input type="hidden" class="field" id="postal_code" name="postalCode" disabled="true" />

              {{--
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">City</label>
                        <input type="text" class="form-control" name="userAddressCity"  id="inputCity">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="inputState">State</label>
                        <select id="inputState"  name="userAddressState"  class="form-control">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="inputZip">Postal Code</label>
                        <input type="text" class="form-control"  name="userAddressPostalCode" id="inputZip">
                    </div>
                </div>
                --}}

                {{--

                <!--  Google places API example -->
                <div id="locationField">
                    <input
                        id="autocomplete"
                        placeholder="Enter your address"
                        onFocus="geolocate()"
                        type="text"
                    />
                </div>

                <!-- Note: The address components in this sample are typical. You might need to adjust them for
                           the locations relevant to your app. For more information, see
                     https://developers.google.com/maps/documentation/javascript/examples/places-autocomplete-addressform
                -->

                <table id="address">
                    <tr>
                        <td class="label">Street address</td>
                        <td class="slimField">
                            <input class="field" id="street_number" disabled="true" />
                        </td>
                        <td class="wideField" colspan="2">
                            <input class="field" id="route" disabled="true" />
                        </td>
                    </tr>
                    <tr>
                        <td class="label">City</td>
                        <td class="wideField" colspan="3">
                            <input class="field" id="locality" disabled="true" />
                        </td>
                    </tr>
                    <tr>
                        <td class="label">State</td>
                        <td class="slimField">
                            <input
                                class="field"
                                id="administrative_area_level_1"
                                disabled="true"
                            />
                        </td>
                        <td class="label">Zip code</td>
                        <td class="wideField">
                            <input class="field" id="postal_code" disabled="true" />
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Country</td>
                        <td class="wideField" colspan="3">
                            <input class="field" id="country" disabled="true" />
                        </td>
                    </tr>
                </table>

                --}}

                <!-- -------------- ---------------- ---------------- ------------ ------ -->

                    {{--
                     <div class="form-row">

                         <div class="form-group col-md-4">
                             <label for="inputCity">{{__('birth month')}}</label>
                             <select id="inputState"  name="birthMonth"  class="form-control {{ $errors->has('birthMonth') ? ' is-invalid' : '' }}">
                                 <option value="">{{__('select month')}}</option>
                                  @foreach($months as $month )
                                     <option value={{$month}} {{ old('birthMonth')==$month ?'selected':''}}>{{$month}}</option>
                                  @endforeach
                             </select>

                             @if($errors->has('birthMonth'))
                                 <span class="invalid-feedback" role="alert">
                                   <strong>{{ $errors->first('birthMonth') }}</strong>
                                 </span>
                             @endif

                         </div>

                         <div class="form-group col-md-4">
                             <label for="inputState">{{__('birth day')}}</label>
                             <select id="inputState"  name="birthDay"  class="form-control {{ $errors->has('birthDay') ? ' is-invalid' : '' }}">
                                 <option value="">{{__('select day')}}</option>
                                 @for ($i=1; $i<=31; $i++)
                                     <option value={{$i}} {{ old('birthDay')==$i ?'selected':''}} >{{$i}}</option>
                                 @endfor
                             </select>

                             @if($errors->has('birthDay'))
                                 <span class="invalid-feedback" role="alert">
                                   <strong>{{ $errors->first('birthDay') }}</strong>
                                 </span>
                             @endif


                         </div>

                         <div class="form-group col-md-4">
                             <label for="inputState">{{__('birth year')}}</label>
                             <select id="inputState"  name="birthYear"  class="form-control {{ $errors->has('birthYear') ? ' is-invalid' : '' }}">
                                 <option value="">{{__('select year')}}</option>
                                 @for ($i=2001; $i>1930; $i--)
                                  <option value={{$i}} {{ old('birthYear')==$i ?'selected':''}}>{{$i}}</option>
                                 @endfor
                             </select>
                             @if($errors->has('birthYear'))
                                 <span class="invalid-feedback" role="alert">
                                   <strong>{{ $errors->first('birthYear') }}</strong>
                                 </span>
                             @endif
                         </div> --}}


            </div>

            <a type="button" href="{{route('register.complete.intro')}}"
              class="btn btn-outline-dark float-left my-5"> <i class="fas fa-arrow-left"></i>
              {{__('back')}}
            </a>


            <button type="submit"  formmethod="post" class="btn btn-success float-right my-5 buttons_style">
                    {{__('next step')}}   <i class="fas fa-arrow-right"></i></button>
            </form>
            </div>

        </div>


        @include('notes.complete-registration-notes')


    </div>

    <br><br><br><br><br><br><br><br><br><br><br>

@endsection

<!--page specific scripts (script for datepicker) -->
@section('scripts')
<script>

    "use strict";

    // This sample uses the Autocomplete widget to help the user select a
    // place, then it retrieves the address components associated with that
    // place, and then it populates the form fields with those details.
    // This sample requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script
    // src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPJpjD-qcR_yIxJnS8maR5W9KB0E3EzYI&libraries=places">
    let placeSearch;
    let autocomplete;
    const componentForm = {
        street_number: "short_name",
        route: "long_name",
        locality: "long_name",
        administrative_area_level_1: "short_name",
        country: "long_name",
        postal_code: "short_name"
    };

    function initAutocomplete() {
        // Create the autocomplete object, restricting the search predictions to
        // geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
            document.getElementById("autocomplete"),
            {
                types: ["geocode"]
            }
        ); // Avoid paying for data that you don't need by restricting the set of
        // place fields that are returned to just the address components.

        autocomplete.setFields(["address_component"]); // When the user selects an address from the drop-down, populate the
        // address fields in the form.

        autocomplete.addListener("place_changed", fillInAddress);
    }

    function fillInAddress() {
        // Get the place details from the autocomplete object.
        const place = autocomplete.getPlace();

        for (const component in componentForm) {
            document.getElementById(component).value = "";
            document.getElementById(component).disabled = false;
        } // Get each component of the address from the place details,
        // and then fill-in the corresponding field on the form.

        for (const component of place.address_components) {
            const addressType = component.types[0];

            if (componentForm[addressType]) {
                const val = component[componentForm[addressType]];
                document.getElementById(addressType).value = val;
            }
        }
    } // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.

    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                const geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                const circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }

</script>
@endsection
