@extends ('layouts.user')

@section('title', 'Register Admin')

@section('content')

    <div class="row">
        <div class="col-sm-8 offset-sm-4">
            <h2 class="display-5">Create Admin</h2> <hr>
            <div>

                <form method="post" action="{{ route('admin.store')}}">
                    @csrf

                    <div class="form-row">

                    <div class="form-group col-md-6">
                        <label>Admin First name </label>
                        <input type="text" class="form-control {{ $errors->has('adminFirstName') ? ' is-invalid' : '' }}"
                               value="{{ old('adminFirstName') }}"  name="adminFirstName"/>

                        @if($errors->has('adminFirstName'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('adminFirstName') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label> Admin last name </label>
                        <input type="text" class="form-control {{ $errors->has('adminLastName') ? ' is-invalid' : '' }}"
                               value="{{ old('adminLastName') }}" name="adminLastName"/>

                        @if($errors->has('adminLastName'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('adminLastName') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label>Admin Email </label>
                        <input type="text" class="form-control {{ $errors->has('adminEmail') ? ' is-invalid' : '' }}"
                               value="{{ old('adminEmail') }}" name="adminEmail"/>

                        @if($errors->has('adminEmail'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('adminEmail') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label>Admin Phone Number</label>
                        <input type="text" class="form-control {{ $errors->has('adminPhoneNumber') ? ' is-invalid' : '' }}"
                               value="{{ old('adminPhoneNumber') }}" name="adminPhoneNumber"/>

                        @if($errors->has('adminPhoneNumber'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('adminPhoneNumber') }}</strong>
                            </span>
                        @endif
                    </div>

                        <div class="form-group col-md-6">
                            <label>Password</label>
                            <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   name="password"/>

                            @if($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   name="password_confirmation"/>

                            @if($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>

                    <div class="form-group col-md-6">
                        <label>Admin address</label>
                        <input type="text" class="form-control {{ $errors->has('adminAddress') ? ' is-invalid' : '' }}"
                               value="{{ old('adminAddress') }}" name="adminAddress"/>

                        @if($errors->has('adminAddress'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('adminAddress') }}</strong>
                            </span>
                        @endif

                    </div>

                    </div>
                    <button type="submit" class="btn btn-info">Create Admin</button>
                </form>
            </div>
        </div>
    </div>


@endsection

