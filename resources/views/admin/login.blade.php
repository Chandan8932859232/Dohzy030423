
@extends('layouts.user')

@section('title', 'Admin Login')

@section('content')

    <div class="row">
        <div class="col-sm-6 offset-sm-4">
            <h3 class="text-center mt-3">Admin Login </h3>
            <hr>

            <form action="" method="POST">
                @csrf
                <div class="form-row">

                    <div class="form-group col-md-12">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control {{ $errors->has('adminEmail') ? ' is-invalid' : '' }}"
                               name="adminEmail"
                               value="{{ old('adminEmail') }}"  id="inputEmail4" placeholder="admin email">

                        @if ($errors->has('adminEmail'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('adminEmail') }}</strong>
                            </span>
                        @endif

                    </div>

                    <div class="form-group col-md-12">
                        <label for="inputPassword4">Password</label>
                        <input type="password" class="form-control {{ $errors->has('adminPassword') ? ' is-invalid' : '' }}"
                               name="adminPassword"
                               id="inputPassword4" placeholder="admin password">

                        @if ($errors->has('adminPassword'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('adminPassword') }}</strong>
                            </span>
                        @endif

                    </div>

                </div>

                <button type="submit" class="btn btn-success btn-block my-3">
                    <i class="fas fa-lock"></i> Login As Admin
                </button>
            </form>

        </div>
    </div>

@endsection
