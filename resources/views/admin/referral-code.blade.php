@extends ('layouts.admin')

@section('title', 'Generate Referral Code')

@section('content')

     <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h3 class="text-center mt-3">Generate Referral Code </h3> <hr>
            <div>

                <form method="post" action="{{ route('save.referral-info') }}">
                    @csrf

                  <div class="form-row">

                      <div class="form-group mt-2  col-md-6">
                          <label>User type</label>
                          <select  name="userType" class="form-control {{ $errors->has('relationship') ? ' is-invalid' : '' }}">
                              <option value="">{{__('please select')}}</option>
                              <option value="1" {{ old('relationship')==1 ? 'selected' :''}}>individual user</option>
                              <option value="2" {{ old('relationship')==2 ? 'selected' :''}}>group member</option>
                              <option value="3" {{ old('relationship')==3 ? 'selected' :''}}>africa user</option>
                          </select>
                          @if($errors->has('userType'))
                              <span class="invalid-feedback" role="alert">
                                           <strong>{{ $errors->first('userType') }}</strong>
                                        </span>
                          @endif
                      </div>

                    <div class="form-group col-md-6">
                        <label>First name </label>
                        <input type="text" name="firstName" value="{{ old('firstName') }}" class="form-control {{ $errors->has('firstName') ? ' is-invalid' : '' }}"/>
                        @if($errors->has('firstName'))
                            <span class="invalid-feedback" role="alert">
                                           <strong>{{ $errors->first('firstName') }}</strong>
                                        </span>
                        @endif
                    </div>

                      <div class="form-group col-md-6">
                          <label>Last name </label>
                          <input type="text" name="lastName" value="{{ old('lastName') }}" class="form-control {{ $errors->has('lastName') ? ' is-invalid' : '' }}" />
                          @if($errors->has('lastName'))
                              <span class="invalid-feedback" role="alert">
                                           <strong>{{ $errors->first('lastName') }}</strong>
                                        </span>
                          @endif
                      </div>

                    <div class="form-group col-md-6">
                       <label> Email </label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" />
                        @if($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                           <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                       <label for="referrer-phone"> Phone </label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" />
                        @if($errors->has('phone'))
                            <span class="invalid-feedback" role="alert">
                                           <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                        @endif
                    </div>


                      <div class="form-group mt-2  col-md-6">
                          <label>relationship between dohzy and user</label>
                          <select  name="relationship" class="form-control {{ $errors->has('relationship') ? ' is-invalid' : '' }}">
                              <option value="">{{__('please select')}}</option>
                              <option value="1" {{ old('relationship')==1 ? 'selected' :''}}>{{__('friend')}}</option>
                              <option value="2" {{ old('relationship')==2 ? 'selected' :''}}>{{__('family')}}</option>
                              <option value="3" {{ old('relationship')==3 ? 'selected' :''}}>{{__('colleague')}}</option>
                              <option value="4" {{ old('relationship')==4 ? 'selected' :''}}>{{__('other')}}</option>
                              <option value="5" {{ old('relationship')==3 ? 'selected' :''}}>unknown user</option>
                          </select>
                          @if ($errors->has('relationship'))
                              <span class="invalid-feedback" role="alert">
                                           <strong>{{ $errors->first('relationship') }}</strong>
                                        </span>
                          @endif
                      </div>


                      <div class="form-group mt-2  col-md-6">
                          <label>Level of trust for this person</label>
                          <select name="trustLevel" class="form-control {{ $errors->has('trustLevel') ? ' is-invalid' : '' }}">
                              <option value="">{{__('please select')}}</option>
                              <option value="high" {{ old('trustLevel')=='high' ? 'selected' :''}}>{{__('high')}}</option>
                              <option value="medium" {{ old('trustLevel')=='medium' ? 'selected' :''}}>{{__('medium')}}</option>
                              <option value="low" {{ old('trustLevel')=='low' ? 'selected' :''}}>{{__('low')}}</option>
                          </select>
                          @if ($errors->has('trustLevel'))
                              <span class="invalid-feedback" role="alert">
                                           <strong>{{ $errors->first('trustLevel') }}</strong>
                                        </span>
                          @endif
                      </div>

                      <div class="form-group col-md-6">
                          <label> Referrer</label>
                          <input name="referrer" value="{{ old('referrer') }}"type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" />
                          @if($errors->has('referrer'))
                              <span class="invalid-feedback" role="alert">
                                           <strong>{{ $errors->first('referrer') }}</strong>
                                        </span>
                          @endif
                      </div>



                </div>
                    <button type="submit" class="btn btn-dohzy btn-block my-3">Generate Code</button>
                </form>
            </div>
        </div>
    </div>


@endsection
