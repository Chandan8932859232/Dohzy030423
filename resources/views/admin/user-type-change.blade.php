@extends ('layouts.admin')

@section('title', 'User Type Change')

@section('content')

    <div class="row">

        <div class="col-md-8 offset-sm-1">
            <h3 class="text-center mt-5">Change User Type</h3>

            <div class="card">
                <div class="card-body">
                    <strong><i class="fas fa-info-circle"></i> Different User Types</strong>
                      <ul>
                          <li>User Type 1 : Individual user</li>
                          <li>User Type 2 : Group member user</li>
                          <li>User Type 3 : Africa based user </li>
                          <li>User Type 4 : Business User</li>
                      
                </div>
            </div>
            <hr>

            <div class="container">

                <form method="post" action="{{route('admin.change-user-type')}}">
                    @csrf

                    <div class="form-row">


                        <div class="form-group col-md-6 mt-4">

                            <label class="form_text">User Id</label>
                            <input type="text"  name="userId"
                                   value="{{old('userId', $userInfo->id)}}"
                                   class="form-control {{ $errors->has('userId') ? ' is-invalid' : '' }}" readonly/>

                            @if ($errors->has('userId'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('userId') }}</strong>
                           </span>
                            @endif

                        </div>

                          
                        <div class="form-group col-md-6 mt-4">

                            <label class="form_text">Current User Type  </label>
                            <input type="text"  name="currentUserType"
                                   value="{{old('currentUserType', $userInfo->user_type)}}"
                                   class="form-control {{ $errors->has('currentUserType') ? ' is-invalid' : '' }}" readonly/>

                            @if ($errors->has('currentUserType'))
                                <span class="invalid-feedback" role="alert">
                                   <strong>{{ $errors->first('currentUserType') }}</strong>
                               </span>
                            @endif

                        </div>

   
                        <div class="form-group col-md-6 mt-4">

                            <label class="form_text">Target User Type  </label>
                            <input type="text"  name="targetUserType"
                                   value="{{old('targetUserType')}}"
                                   class="form-control {{ $errors->has('targetUserType') ? ' is-invalid' : '' }}" />

                            @if ($errors->has('targetUserType'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('targetUserType') }}</strong>
                           </span>
                            @endif

                        </div>

                       

                        <br>

                    <button type="submit" class="btn btn-dark btn-block mt-3 mb-5 ">
                        <i class="far fa-paper-plane"></i> Change User Type
                    </button>
                </form>
            </div>
        </div>






    </div>


@endsection


@section('scripts')

@endsection
