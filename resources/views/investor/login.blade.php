
@extends('layouts.investor')

@section('title', 'Investor Login')

@section('content')

    <div class="row">
        <div class="col-sm-6 offset-sm-4">
            <h3 class="text-center mt-3">Investor Login </h3>
            <hr>

            <form action="{{ route('investor.login-handle') }}" method="POST">
                @csrf
                <div class="form-row">

                    <div class="form-group col-md-12">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control {{ $errors->has('adminEmail') ? ' is-invalid' : '' }}"
                               name="email"
                               value="{{ old('email') }}"  id="inputEmail4" placeholder="investor email">

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif

                    </div>

                    <div class="form-group col-md-12">
                        <label for="inputPassword4">Password</label>
                        <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                               name="password"
                               id="inputPassword4" placeholder="password">

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif

                    </div>

                </div>

                <button type="submit" class="btn btn-success btn-block my-3">
                    <i class="fas fa-lock"></i> Login As Investor
                </button>
            </form>

        </div>
    </div>

@endsection
