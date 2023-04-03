@extends('layouts.user')

@section('title', 'Complete Profile')

@section('content')

    <div class="row">
        <div class="col-sm-8">

            <h3 class="text-center mt-3 form_title">{{__('complete your profile')}}</h3>
            <hr>
            <div class="container">

                <form action="{{ route('process.complete.africa') }}" method="POST">
                    @csrf
                    <div class="form-row">


                        <div class="form-group col-md-6 mt-2">
                            <label class="required">{{__('gender')}}</label>
                            <select id="inputState"  name="gender"  class="form-control {{ $errors->has('gender') ? ' is-invalid' : '' }}">
                                <option value="" selected>{{__('choose gender')}}</option>
                                <option value="m" {{ old('gender')=="m" ?'selected':''}} >{{__('male')}}</option>
                                <option value="f" {{ old('gender')=="f" ?'selected':''}} >{{__('female')}}</option>
                            </select>

                            @if ($errors->has('gender'))
                                <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('gender') }}</strong>
                            </span>
                            @endif
                        </div>


                        <div class="form-group col-md-6 mt-2">
                            <label class="required">{{__('birth year')}}</label>
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
                        </div>

                        <div class="form-group col-md-6 mt-2">
                            <label class="required">{{__('country of residence')}}</label>
                            <select id="inputState"  name="countryOfResidence"  class="form-control {{ $errors->has('countryOfResidence') ? ' is-invalid' : '' }}">
                                <option value="">{{__('choose country')}}</option>

                                @foreach($countryInfo as $code=> $country)

                                    <option value={{$code}} {{ old('countryOfResidence')==$code ?'selected':''}}>{{ucwords(strtolower($country['name']))}}</option>

                                @endforeach

                            </select>

                            @if ($errors->has('countryOfResidence'))
                                <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('countryOfResidence') }}</strong>
                           </span>
                            @endif
                        </div>

                        <div class="form-group col-md-6 mt-2">
                            <label class="required">{{__('province')}}</label>
                            <input type="text"   class="form-control {{ $errors->has('province') ? ' is-invalid' : '' }}"
                                   name="province"  value="{{ old('province') }}"
                                   placeholder="{{__('province')}}">
                            @if($errors->has('province'))
                                <span class="invalid-feedback" role="alert">
                         <strong>{{ $errors->first('province') }}</strong>
                       </span>
                            @endif
                        </div>


                        <div class="form-group col-md-6 mt-2">
                            <label class="required">{{__('city')}}</label>
                            <input type="text"  class="form-control {{ $errors->has('city') ? ' is-invalid' : '' }}"
                                   name="city"  value="{{ old('city') }}"
                                   placeholder="{{__('city')}}">
                            @if($errors->has('city'))
                                <span class="invalid-feedback" role="alert">
                         <strong>{{ $errors->first('city') }}</strong>
                       </span>
                            @endif
                        </div>


                        <div class="form-group col-md-6 mt-2">
                            <label>{{__('address')}}</label>
                            <input type="text"  class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}"
                                   name="address"  value="{{ old('address') }}"
                                   placeholder="{{__('address')}}">
                            <small> Name of Neighborhood(Quartier)  </small>

                            @if($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                         <strong>{{ $errors->first('address') }}</strong>
                       </span>
                            @endif
                        </div>



                    </div>


                    <button type="submit"  formmethod="post" class="btn btn-success my-3 buttons_style">
                        {{__('next')}} <i class="fas fa-arrow-alt-circle-right"></i></button>
                </form>
            </div>

        </div>


        @include('notes.complete-registration-notes')


    </div>

@endsection

<!--page specific scripts (script for datepicker) -->
@section('scripts')
    <script>


    </script>
@endsection
