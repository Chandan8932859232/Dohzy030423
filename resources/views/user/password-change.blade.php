@extends('layouts.user')


@section('title', 'Change Password')

@section('content')


    <div class="row">

        <div class="col-sm-8 offset-sm-0">
            <h3 class="text-center mt-3 form_title">{{ __('change your password')}} </h3>
            <hr>

            <div class="container">
                <form  method="POST" action="{{route('change.password')}}">
                    @method('PUT')
                    @csrf

                    <label for="password" class="mt-2"> {{__('current password')}}  </label>
                    <input type="password" name="currentPassword" value="{{ old('currentPassword') }}"
                           class="form-control{{ $errors->has('currentPassword') ? ' is-invalid' : '' }}" >

                    @if ($errors->has('currentPassword'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('currentPassword') }}</strong>
                    </span>
                    @endif

                    <div class="form-group">
                    <label for="password" class="mt-3"> {{__('new password')}} </label>
                    <input type="password" name="newPassword"  value="{{ old('newPassword') }}"
                           class="form-control{{ $errors->has('newPassword') ? ' is-invalid' : '' }}" >

                    <span><small> {{__('user password rules')}}</small></span>

                    @if ($errors->has('newPassword'))
                        <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('newPassword') }}</strong>
                    </span>
                    @endif
                    </div>


                    <label for="password" class="mt-1"> {{__('confirm new password')}}</label>
                    <input type="password" name="newPassword_confirmation"  value="{{ old('newPassword_confirmation') }}"
                           class="form-control{{ $errors->has('newPassword_confirmation') ? ' is-invalid' : '' }}" >

                    @if ($errors->has('newPassword_confirmation'))
                        <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('newPassword_confirmation') }}</strong>
                    </span>
                    @endif

                    <button   type="submit" class="btn btn-success my-4 buttons_style">
                        <i class="fas fa-lock"></i> {{__('change password')}}
                    </button>

                </form>
            </div>

        </div>

        @include('notes.password-notes')

    </div>


@endsection

