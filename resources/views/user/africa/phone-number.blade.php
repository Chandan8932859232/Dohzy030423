@extends('layouts.user')

@section('title', 'Phone')

@section('content')


    <div class="row">
        <div class="col-sm-8">
            <h3 class="text-center mt-3 form_title">Provide Phone Number</h3>
            <hr>

            <div class="container">
            <form action="{{ route('check.phone.africa') }}" method="POST">
                @csrf
                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label>Phone type</label>
                        <select id="inputState"  name="phoneType"  class="form-control">
                            <option value ="mobile" selected>Mobile</option>
                            <option value ="home" >Home</option>
                            <option value ="work" >Work</option>
                        </select>
                        <small>We recommend mobile</small>
                        @if ($errors->has('phoneType'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('phoneType') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-md-8">
                        <label>Phone number</label>
                        <div class="input-group">
                            {{--
                            <div class="input-group-prepend">
                                <span class="input-group-text">+1 </span>
                            </div>
                            --}}



                            <input type="tel" class="form-control {{ $errors->has('phoneNumber') ? ' is-invalid' : '' }}"
                                   name="phoneNumber" value="{{ old('phoneNumber') }}"  id="inputPhone" placeholder="Phone number">
                            @if ($errors->has('phoneNumber'))
                                <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('phoneNumber') }}</strong>
                           </span>
                            @endif
                        </div>
                        <small>Please do not add spaces or dashes to the number</small>

                    </div>


                </div>

                <button type="submit" class="btn btn-success btn-block my-3 buttons_style">
                     Submit Phone</button>
            </form>
            </div>

        </div>

      {{--  @include('notes.phone-number-notes') --}}


    </div>


@endsection
