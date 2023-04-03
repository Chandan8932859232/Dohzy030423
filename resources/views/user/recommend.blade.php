@extends ('layouts.user')

@section('title', 'Recommend')

@section('content')

            <div class="row">

                <div class="col-md-8 offset-sm-0">
                    <h3 class="text-center mt-3 form_title">{{__('refer a friend')}} </h3>
                    <hr class="mb-3">

                    <div class="container">

                        <div class="card mt-5 mb-5 notes_style">
                            <div class="card-body"> <i class="fas fa-info-circle icon_color"></i>
                               {{__('the person you are referring')}}
                            </div>
                        </div>

                        <form method="post" action="{{route('referral.handle')}}">
                            @csrf

                            <div class="form-row">

                                <div class="form-group mt-2 col-md-6">
                                    <label>{{__('firstname')}} </label>
                                    <input type="text" name="firstName" class="form-control {{ $errors->has('firstName') ? ' is-invalid' : '' }}"
                                           value="{{old('firstName')}}" />

                                    @if ($errors->has('firstName'))
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('firstName') }}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group mt-2  col-md-6">
                                    <label>{{__('lastname')}} </label>
                                    <input type="text" name="lastName" class="form-control {{ $errors->has('lastName') ? ' is-invalid' : '' }}"
                                           value="{{old('lastName')}}"/>

                                    @if ($errors->has('lastName'))
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('lastName') }}</strong>
                                         </span>
                                    @endif

                                </div>

                                <div class="form-group mt-2  col-md-6">
                                    <label> {{__('email')}} </label>
                                    <input type="text" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           value="{{old('email')}}"/>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('email') }}</strong>
                                         </span>
                                    @endif

                                </div>

                                <div class="form-group mt-2  col-md-6">
                                    <label for="phone"> {{__('phone')}} </label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+1 </span>
                                        </div>

                                    <input type="text" name="phoneNumber" class="form-control  {{ $errors->has('phoneNumber') ? ' is-invalid' : '' }}"
                                           value="{{old('phoneNumber')}}" placeholder= "{{__('must be a canada number')}}"/>

                                    @if ($errors->has('phoneNumber'))
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('phoneNumber') }}</strong>
                                         </span>
                                    @endif

                                </div>
                                <small><strong>{{__('please do not add spaces or dashes to the number')}}</strong></small>
                              </div>


                                <div class="form-group mt-2  col-md-6">
                                    <label>{{__('relationship with person')}}</label>
                                    <select  name="relationship" class="form-control {{ $errors->has('relationship') ? ' is-invalid' : '' }}">
                                        <option value="">{{__('please select')}}</option>
                                        <option value="1" {{ old('relationship')==1 ? 'selected' :''}}>{{__('friend')}}</option>
                                        <option value="2" {{ old('relationship')==2 ? 'selected' :''}}>{{__('family')}}</option>
                                        <option value="3" {{ old('relationship')==3 ? 'selected' :''}}>{{__('colleague')}}</option>
                                        <option value="4" {{ old('relationship')==4 ? 'selected' :''}}>{{__('other')}}</option>
                                    </select>
                                    @if ($errors->has('relationship'))
                                        <span class="invalid-feedback" role="alert">
                                           <strong>{{ $errors->first('relationship') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                <div class="form-group mt-2  col-md-6">
                                    <label>{{__('what is your trust level of this')}}</label>
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


                                <div class="form-group mt-2  col-md-6">
                                    <label>{{__('preferred language of the person')}}</label>
                                    <select name="language" class="form-control {{ $errors->has('language') ? ' is-invalid' : '' }}">
                                        <option value="">{{__('please select')}}</option>
                                        <option value="en" {{ old('language')=='en' ? 'selected' :''}}>{{__('english')}}</option>
                                        <option value="fr" {{ old('language')=='fr' ? 'selected' :''}}>{{__('french')}}</option>
                                    </select>
                                    @if ($errors->has('language'))
                                        <span class="invalid-feedback" role="alert">
                                           <strong>{{ $errors->first('language') }}</strong>
                                        </span>
                                    @endif
                                </div>


                            </div>

                            <button type="submit" class="btn btn-success mt-4 mb-4 mb-3 buttons_style">
                                <i class="fas fa-user-plus"></i> {{__('recommend')}}
                            </button>
                        </form> <br><br>
                    </div>
                </div>



                @include('notes.recommend-user-notes')



    </div>


@endsection



