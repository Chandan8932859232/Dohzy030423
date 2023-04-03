@extends('layouts.user')

@section('title', 'Phone')

@section('content')


    <div class="row">
        <div class="col-sm-8">


            <div class="container mt-5 mb-4">
                <div class="card text-dark notes_style">
                    <div class="card-body">
                       <p class="ml-3 mb-3"> <i class="fas fa-arrow-circle-right site_points"></i>  {{__('only canadian mobile numbers are allowed')}}</li>
                       <p class="ml-3 mb-2"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('a verification code will be sent to the number provided')}}</li>
                    </div>
                </div>
            </div>


            <h3 class="text-center mt-5 mb-2 form_title">{{__('provide phone number')}}</h3>
            <hr>

         <div class="container mt-5">
            <form action="{{ route('check.phone') }}" method="POST">
                @csrf
                <div class="form-row">
                   {{--
                    <div class="form-group col-md-4">
                        <label>{{__('phone type')}}</label>
                        <select id="inputState"  name="phoneType"  class="form-control">
                            <option value ="mobile" selected>{{__('mobile phone')}}</option>
                            <option value ="home" >{{__('home phone')}}</option>
                            <option value ="work" >{{__('work phone')}}</option>
                        </select>
                        <small>{{__('we recommend mobile')}}</small>
                        @if ($errors->has('phoneType'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('phoneType') }}</strong>
                            </span>
                        @endif
                    </div>
                    --}}

                  <div class="col-md-12">
                      <label>{{__('phone number')}}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">+1 </span>
                        </div>



                        <input type="tel" style="height:50px;" class="form-control {{ $errors->has('phoneNumber') ? ' is-invalid' : '' }}"
                               name="phoneNumber" value="{{ old('phoneNumber') }}"  id="inputPhone" >
                        @if ($errors->has('phoneNumber'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('phoneNumber') }}</strong>
                           </span>
                        @endif
                    </div>
                      <small>{{__('do not add spaces or dashes to the number')}}</small>

                  </div>


                </div>


                <button type="submit" class="btn btn-success my-5  float-left buttons_style">
                   {{__('Next')}} <i class="fas fa-arrow-right"></i>
                </button>

            </form>
         </div>

        </div>

     {{--@include('notes.phone-number-notes')--}}


    </div>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>


@endsection
