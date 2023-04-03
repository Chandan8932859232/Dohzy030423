@extends('layouts.user')

@section('title', 'User Profile')

@section('content')

    @inject('user', 'App\Models\User')


    <div class="row">
        <div class="col-sm-8">
            <h3 class="text-center mt-3 mb-2 form_title">{{ __('your profile information') }} </h3>


            <div class="container mt-4">

                <table class="table ">

                    <tbody>
                        <tr>
                            <td>
                                {{ __('account type') }} :
                                @if ($userInfo->user_type == 1)
                                    <strong><i class="fas fa-user"></i> {{ __('personal') }}</strong>
                                @endif

                                @if ($userInfo->user_type == 2)
                                    <strong><i class="fa-regular fa-users"></i> {{ __('group member') }}</strong>
                                @endif

                                @if ($userInfo->user_type == 3)
                                    <strong><i class="fa-regular fa-earth-africa"></i> {{ __('africa based user') }}</strong>
                                @endif

                                @if ($userInfo->user_type == 4)
                                    <strong><i class="fa-regular fa-briefcase"></i> {{ __('business') }}</strong>
                                @endif

                            </td>

                            <td> {{ __('account id') }} : <strong>{{ $userInfo->account_id }}</strong></td>

                        </tr>


                        <tr>

                            <td>
                                {{ __('account status') }} :

                                @if ($userInfo->profile_complete_status == 0)
                                    <span class="badge badge-success">{{ __('incomplete') }}</span>
                                @endif

                                @if ($userInfo->profile_complete_status == 1)
                                    <span class="badge badge-success">{{ __('complete') }}</span>
                                @endif


                            </td>

                            @php
                                $createdDateTime = explode(' ', $userInfo->created_at);
                                $createdDate = $createdDateTime[0];
                            @endphp


                            <td>{{ __('member since') }}: <strong>{{ $createdDate }}</strong>


                            </td>

                        </tr>

                    </tbody>
                </table>
            </div>
            <hr>
            <div class="container">
                <br><br>
                <div id="accordion">
                    <div class="card">
                        <div class="card-header">
                            <a class="card-link" data-toggle="collapse" href="#collapseOne">
                                <strong class="profile_info_title"><i class="far fa-user"></i> {{ __('user profile') }}
                                </strong>
                            </a>
                        </div>
                        <div id="collapseOne"
                            class="collapse {{ session()->has('userProfileUpdate') || $errors->has('firstname') || $errors->has('lastname') || $errors->has('language') || $errors->has('gender') || $errors->has('birthYear') || $errors->has('countryOfOrigin') ? ' show' : '' }}"
                            data-parent="#accordion">
                            <div class="card-body">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ __('errors') }}:</strong>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if (session()->has('message') && session()->has('userProfileUpdate'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>{{ __('success') }}:</strong>
                                        {{ session()->get('message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <div class="container">
                                    <form action="{{ route('profile.update', ['user_id' => $user->getUserId()]) }}"
                                        method="post">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-6 mt-2">
                                                <label for="inputEmail4">{{ __('firstname') }}</label>
                                                <input type="text"
                                                    class="form-control {{ $errors->has('firstname') ? ' is-invalid' : '' }}"
                                                    name="firstname" value="{{ old('firstname', $userInfo->firstname) }}"
                                                    id="first_name">
                                                @if ($errors->has('firstname'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('firstname') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group col-md-6 mt-2">
                                                <label for="inputEmail4">{{ __('lastname') }}</label>
                                                <input type="text"
                                                    class="form-control {{ $errors->has('lastname') ? ' is-invalid' : '' }}"
                                                    name="lastname" value="{{ old('lastname', $userInfo->lastname) }}"
                                                    id="inputlastname">
                                                @if ($errors->has('lastname'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('lastname') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            {{--

                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">{{ __('email')}}</label>
                                                <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                       name="email" value="{{ old('email',$userInfo->email) }}"  id="inputEmail4" placeholder="Email">
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                                 </span>
                                                @endif
                                            </div>
                                        --}}
                                            <?php
                                            
                                            $result = DB::table('users')
                                                ->where('id', $user_id)
                                                ->first();
                                            $res = $result->language;
                                            //    dd($res);
                                            ?>

                                            <div class="form-group col-md-6 mt-2">
                                                <label>{{ __('language of correspondence') }}</label>
                                                <select name="language"
                                                    class="form-control {{ $errors->has('language') ? ' is-invalid' : '' }}">

                                                    <option {{ old('language', $res) == 'English' ? 'selected' : '' }}>
                                                        {{ __('english') }}</option>
                                                    <option {{ old('language', $res) == 'French' ? 'selected' : '' }}>
                                                        {{ __('french') }}</option>
                                                </select>
                                                @if ($errors->has('language'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('language') }}</strong>
                                                    </span>
                                                @endif
                                            </div>


                                            <div class="form-group col-md-6 mt-2">
                                                <label for="inputEmail4">{{ __('gender') }}</label>
                                                <select name="gender"
                                                    class="form-control {{ $errors->has('gender') ? ' is-invalid' : '' }}">
                                                    <option value="m"
                                                        {{ old('gender', $userInfo->gender) == 'm' ? 'selected' : '' }}>
                                                        {{ __('male') }}</option>
                                                    <option value="f"
                                                        {{ old('gender', $userInfo->gender) == 'f' ? 'selected' : '' }}>
                                                        {{ __('female') }}</option>
                                                </select>

                                            </div>


                                            {{--
                                             <div class="form-group col-md-4">
                                                 <label for="inputCity">{{ __('birth month')}}</label>
                                                 <select id="inputState"  name="birthMonth"  class="form-control {{ $errors->has('birthMonth') ? ' is-invalid' : '' }}">
                                                     @foreach ($months as $month)
                                                         <option value={{$month}} {{ old('birthMonth', $savedBirthMonth)==$month ?'selected':''}}>{{$month}}</option>
                                                     @endforeach
                                                 </select>

                                                 @if ($errors->has('birthMonth'))
                                                     <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $errors->first('birthMonth') }}</strong>
                                                 </span>
                                                 @endif

                                             </div>


                                             <div class="form-group col-md-4">
                                                 <label for="inputState">{{ __('birth day')}}</label>
                                                 <select id="inputState"  name="birthDay"  class="form-control {{ $errors->has('birthDay') ? ' is-invalid' : '' }}">
                                                     <option value="">{{__('select day')}}</option>
                                                     @for ($i = 1; $i <= 31; $i++)
                                                         <option value={{$i}} {{ old('birthDay', $savedBirthDay)==$i ?'selected':''}} >{{$i}}</option>
                                                     @endfor
                                                 </select>

                                                 @if ($errors->has('birthDay'))
                                                     <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $errors->first('birthDay') }}</strong>
                                                 </span>
                                                 @endif

                                             </div> --}}

                                            <div class="form-group col-md-6 mt-2">
                                                <label>{{ __('birth year') }}</label>
                                                <select name="birthYear"
                                                    class="form-control {{ $errors->has('birthYear') ? ' is-invalid' : '' }}">
                                                    <option value="">{{ __('select year') }}</option>
                                                    @for ($i = 2001; $i > 1930; $i--)
                                                        <option value={{ $i }}
                                                            {{ old('birthYear', $userInfo->birth_date) == $i ? 'selected' : '' }}>
                                                            {{ $i }}</option>
                                                    @endfor
                                                </select>

                                                @if ($errors->has('birthYear'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('birthYear') }}</strong>
                                                    </span>
                                                @endif
                                            </div>


                                            <div class="form-group col-md-6 mt-2">
                                                <label class="form_text">{{ __('country of origin') }}</label>
                                                <select id="inputState" name="countryOfOrigin"
                                                    class="form-control {{ $errors->has('countryOfOrigin') ? ' is-invalid' : '' }}">
                                                    <option value="">{{ __('choose country of origin') }}</option>

                                                    @foreach ($countryInfo as $code => $country)
                                                        <option value={{ $code }}
                                                            {{ old('countryOfOrigin', $userInfo->country_of_origin) == $code ? 'selected' : '' }}>
                                                            {{ ucwords(strtolower($country['name'])) }}</option>
                                                    @endforeach

                                                </select>
                                                <small><i class="fas fa-info-circle"></i>
                                                    {{ __('if born in canada or not') }}
                                                </small>

                                                @if ($errors->has('countryOfOrigin'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('countryOfOrigin') }}</strong>
                                                    </span>
                                                @endif
                                            </div>


                                        </div>


                                        <button type="submit" class="btn  my-3 text-white buttons_style">
                                            {{ __('edit information') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header">
                            <a class="collapsed card-link " data-toggle="collapse" href="#collapseTwo">
                                <strong class="profile_info_title"><i class="fas fa-map-marked-alt"></i>
                                    {{ __('address') }}</strong>
                            </a>
                        </div>
                        <div id="collapseTwo"
                            class="collapse {{ session()->has('userAddressUpdate') || $errors->has('address') ? ' show' : '' }}"
                            data-parent="#accordion">
                            <div class="card-body">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ __('errors') }}:</strong>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if (session()->has('message') && session()->has('userAddressUpdate'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>{{ __('success') }}:</strong>
                                        {{ session()->get('message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <p class="mb-4 mt-3"><strong>{{ __('address') }}</strong> :
                                    {{ $userAddress->address_info ? $userAddress->address_info . ',' : '' }}
                                    {{ $userAddress->city ? $userAddress->city . ',' : '' }}
                                    {{ $userAddress->province ? $userAddress->province . ',' : '' }}
                                    {{ $userAddress->country }}</p>
                                <hr>

                                <div class="form-group col-md-6 mt-4" id="locationField">
                                    <form
                                        action="{{ route('profile.address-update', ['user_id' => $user->getUserId()]) }}"
                                        method="post">
                                        @method('PUT')
                                        @csrf

                                        <div class="form-group" id="locationField">
                                            <label class="form_text">{{ __('change address') }}</label>
                                            <input type="text" id="autocomplete"
                                                class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}"
                                                name="address" value="{{ old('address') }}"
                                                placeholder="{{ __('enter your residential address') }}">
                                            @if ($errors->has('address'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <button type="submit" class="btn my-3 text-white buttons_style">
                                            {{ __('change address') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="card">
                        <div class="card-header">
                            <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
                                <strong class="profile_info_title"><i class="fas fa-phone"></i>
                                    {{ __('phone') }}</strong>
                            </a>
                        </div>
                        <div id="collapseThree"
                            class="collapse  {{ session()->has('userPhoneUpdate') || $errors->has('phoneNumber') ? ' show' : '' }}"
                            data-parent="#accordion">
                            <div class="card-body">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ __('errors') }}:</strong>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                @if (session()->has('message') && session()->has('userPhoneUpdate'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>{{ __('success') }}:</strong>
                                        {{ session()->get('message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif


                                <div class="container">
                                    <form action="{{ route('update.phone') }}" method="POST">
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>{{ __('phone type') }}</label>
                                                <select name="phoneType" class="form-control">
                                                    <option
                                                        {{ old('phoneType', $userPhone->phone_type) == 'Mobile Phone' ? 'selected' : '' }}>
                                                        {{ __('mobile phone') }}</option>
                                                    <option
                                                        {{ old('phoneType', $userPhone->phone_type) == 'Home Phone' ? 'selected' : '' }}>
                                                        {{ __('home phone') }}</option>
                                                    <option
                                                        {{ old('phoneType', $userPhone->phone_type) == 'Work Phone' ? 'selected' : '' }}>
                                                        {{ __('work phone') }}</option>
                                                </select>
                                                <small>{{ __('we recommend mobile') }}</small>
                                                @if ($errors->has('phoneType'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('phoneType') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="col-md-8">
                                                <label>{{ __('phone number') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">+1 </span>
                                                    </div>


                                                    <input type="tel"
                                                        class="form-control {{ $errors->has('phoneNumber') ? ' is-invalid' : '' }}"
                                                        name="phoneNumber"
                                                        value="{{ old('phoneNumber', $userPhone->phone_number) }}"
                                                        id="inputPhone" placeholder="Phone number">
                                                    @if ($errors->has('phoneNumber'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('phoneNumber') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <small>{{ __('do not add spaces or dashes to the number') }}</small>

                                            </div>


                                        </div>

                                        <button type="submit" class="btn my-3 text-white buttons_style">
                                            {{ __('submit phone') }}</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <br>



                    {{-- <p class="mb-4 mt-3"><strong>{{ __('userBank_info') }}</strong> :
                        {{ $userBank_info->institutionNumber ? $userBank_info->institutionNumber . ',' : '' }}
                        {{ $userBank_info->transitNumber ? $userBank_info->transitNumber . ',' : '' }}
                        {{ $userBank_info->accountNumber ? $userBank_info->accountNumber . ',' : '' }}
                    </p>
                    <hr> --}}

                    <div class="card">
                        <div class="card-header">
                            <a class="collapsed card-link" data-toggle="collapse" href="#collapseFour">
                                <strong class="profile_info_title"><i class="fas fa-university"></i> Banking Information
                                </strong>
                            </a>
                        </div>

                        <div id="collapseFour"
                            class="collapse
                         {{ session()->has('userBank_info') || $errors->has('institutionNumber') || $errors->has('transitNumber') || $errors->has('accountNumber') || $errors->has('voidChequeImage') ? ' show' : '' }}"
                            data-parent="#accordion">
                            <div class="card-body">

                                <form action="{{ route('banking-info.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $user_id }}" name="user_id">

                                    <div class="form-group col-md-12 mt-3">
                                        <label class="form_text required">{{ __('institution number') }}</label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('institutionNumber') ? ' is-invalid' : '' }}"
                                            name="institutionNumber"
                                            value="{{ old('institutionNumber', $userBank_info->institution_number) }}">
                                        <small>{{ __('three digits for most canadian banks') }}</small>
                                        @if ($errors->has('institutionNumber'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('institutionNumber') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-12 mt-2">


                                        <label
                                            class="form_text required">{{ __('transit number') }}/{{ __('branch number') }}</label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('transitNumber') ? ' is-invalid' : '' }}"
                                            name="transitNumber"
                                            value="{{ old('transitNumber', $userBank_info->transit_number) }}">
                                        <small>{{ __('five digits for most canadian banks') }}</small>
                                        @if ($errors->has('transitNumber'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('transitNumber') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-12 mt-2 mb-4">
                                        <label class="form_text required">{{ __('account number') }}</label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('accountNumber') ? ' is-invalid' : '' }}"
                                            name="accountNumber" id="input_field"
                                            value="{{ old('accountNumber', $userBank_info->account_number) }}">
                                        <small>{{ __('seven to 12 digits for most canadian banks') }}</small>
                                        @if ($errors->has('accountNumber'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('accountNumber') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <?php
                                    $images = DB::table('bank_account_information')
                                        ->where('user_id', $user_id)
                                        ->first();
                                    $result = $images->void_cheque;
                                    // dd($images)
                                    ?>

                                    <img src='{{ asset($result) }}'; width="100px" height="100px">
                                    <br>
                                    <label
                                        class="form_text required">{{ __('upload void cheque of bank account') }}</label>

                                    <div class="form-group col-md-12   mb-3 custom-file">
                                        <input type="file" name="voidChequeImage" id="customFile"
                                            class="custom-file-label" value="{{ old('voidChequeImage') }}"
                                            class="custom-file-input form-control {{ $errors->has('voidChequeImage') ? ' is-invalid' : '' }} ">

                                        @if ($errors->has('voidChequeImage'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('voidChequeImage') }}</strong>
                                            </span>
                                        @endif
                                    </div>


                                    {{-- <div class="form-group col-md-12   mb-3 custom-file">

                                        <input type="file" name="voidChequeImage"
                                            class="custom-file-input form-control {{ $errors->has('voidChequeImage') ? ' is-invalid' : '' }}"
                                            id="customFile" value="{{ old('voidChequeImage') }}">
                                        <label class="custom-file-label"
                                            for="customFile">{{ __('choose file to upload') }}
                                        </label>

                                        @if ($errors->has('voidChequeImage'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('voidChequeImage') }}</strong>
                                            </span>
                                        @endif

                                    </div> --}}


                                    <button type="submit" class="btn my-3 text-white buttons_style">
                                        {{ __('submit') }}</button>

                                </form>
                            </div>

                        </div>


                    </div> <br>



                    {{-- <div class="card">
                      <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#collapseFive">
                          <strong class="profile_info_title"><i class="fas fa-file-alt"></i> Uploaded Documents </strong>
                        </a>
                      </div>
                      <div id="collapseFive" class="collapse" data-parent="#accordion">

                        <div class="card-body">

                        <p><strong>Identification Document</strong></p>
                          <img src="https://www.w3schools.com/images/w3schools_green.jpg" alt="Girl in a jacket" style="width:300px;height:300px;">

                        <p><strong>Void cheque</strong></p>
                          <img src="https://www.w3schools.com/images/w3schools_green.jpg" alt="Girl in a jacket" style="width:300px;height:300px;">


                        </div>

                      </div>
                    </div> --}}


                </div>
                <br><br>


            </div>

        </div>

        @include('notes.profile-information-change-notes')

    </div>


    <script>
        var inputField = document.getElementById("input_field");
        inputField.addEventListener("input", function() {
            if (inputField.value.length > 12) {
                inputField.value = inputField.value.slice(0, 12);
            }
        });
    </script>



@endsection


@section('scripts')

    @include('js-snippets.google-places')

@endsection
