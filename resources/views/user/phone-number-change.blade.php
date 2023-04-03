@extends('layouts.user')

@section('title', 'Phone')

@section('content')


    <div class="row">
        <div class="col-sm-8">
            <h3 class="text-center mt-3 form_title">{{__('provide phone number')}}</h3>
            <hr>

            <form action="{{ route('check.phone') }}" method="POST">
                @csrf
                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label>{{__('phone type')}}</label>
                        <select id="inputState"  name="phoneType"  class="form-control">
                            <option selected>{{__('mobile phone')}}</option>
                            <option>{{__('home phone')}}</option>
                            <option>{{__('work phone')}}</option>
                        </select>
                        <small>{{__('we recommend mobile')}}</small>
                        @if ($errors->has('phoneType'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('phoneType') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-md-8">
                        <label>{{__('phone number')}}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+1 </span>
                            </div>



                            <input type="tel" class="form-control {{ $errors->has('phoneNumber') ? ' is-invalid' : '' }}"
                                   name="phoneNumber" value="{{ old('phoneNumber') }}"  id="inputPhone" placeholder="Phone number">
                            @if ($errors->has('phoneNumber'))
                                <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('phoneNumber') }}</strong>
                           </span>
                            @endif
                        </div>
                        <small>{{__('do not add spaces or dashes to the number')}}</small>

                    </div>


                </div>

                <button type="submit" class="btn btn-success btn-block my-3 buttons_style">
                    {{__('submit phone')}}</button>
            </form>

        </div>


         @include('notes.phone-number-notes')


    </div>


@endsection
