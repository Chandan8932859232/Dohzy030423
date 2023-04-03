
@extends('layouts.user')

@section('title', 'Create Account')

@section('content')

<style>
    /* The message box is shown when the user clicks on the password field */
    /* https://www.w3schools.com/howto/howto_js_password_validation.asp */
    #message {
    display:none;
    background:#ffffff;/*#3490dc;*/ /*#ede9ff;*/ /*#f1f1f1;*/
    color: #000;
    position: relative;
    padding: 20px;
    margin-top: 10px;
    }

    #message p {
    padding: 10px 35px;
    font-size: 14px;
    }

    /* Add a green text color and a checkmark when the requirements are right */
    .valid {
    color: green;
    }

    .valid:before {
    position: relative;
    left: -35px;
    content: "✔";
    }

    /* Add a red text color and an "x" when the requirements are wrong */
    .invalid {
    color: red;
    }

    .invalid:before {
    position: relative;
    left: -35px;
    content: "✖";
    }
    </style>

<div class="container">
  <div class="col-sm-6 offset-sm-4">
    <h3 class="text-center mt-4 form_title" style="color:#312A5C; font-weight:700;">{{__('create an account for free')}}</h3>
     <hr>

<form action="{{ route('user.register') }}" method="POST">
@csrf
  <div class="form-row">

   <div class="form-group mt-1 col-md-12">
      <label class="form_text required">{{__('email')}}</label>
      <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
             value="{{ old('email') }}"  id="inputEmail4" >
        @if ($errors->has('email'))
          <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('email') }}</strong>
          </span>
        @endif

    </div>

    <div class="form-group mt-1 col-md-6">
      <label class="form_text required">{{__('firstname')}}</label>
      <input type="text" class="form-control {{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname"
             value="{{ old('firstname') }}" id="first_name"  >
        @if ($errors->has('firstname'))
          <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('firstname') }}</strong>
          </span>
        @endif
    </div>

    <div class="form-group mt-1 col-md-6">
      <label class="form_text required">{{__('lastname')}}</label>
      <input type="text" class="form-control {{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname"
             value="{{ old('lastname') }}"  id="inputlastname" >
        @if ($errors->has('lastname'))
          <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('lastname') }}</strong>
          </span>
        @endif
    </div>

    <div class="form-group mt-1 col-md-6">
      <label class="form_text required" for="inputPassword4">{{__('password')}}</label>
      <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
             id="inputPassword"  value="{{ old('password') }}"
          {{--pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" --}}>

        <!-- An element to toggle between password visibility -->
        <input class="mt-2" type="checkbox" onclick="passwordHideShowFunction()"><small> {{__('show password')}}</small>

        @if ($errors->has('password'))
          <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('password') }}</strong>
          </span>
        @endif
    </div>



      <div id="message" class="col-md-12">
          <strong>{{__('password must contain the following')}}</strong>
          <p id="letter" class="invalid"> <strong>{{__('a lowercase letter')}}</strong></p>
          <p id="capital" class="invalid"><strong>{{__('a capital letter')}}</strong> </p>
          <p id="number" class="invalid"> <strong>{{__('a number')}}</strong></p>
          <p id="symbol" class="invalid"><strong>{{__('a symbol')}}(#,&,-,*,%,@)</strong></p>
          <p id="length" class="invalid"><strong> {{__('minimum 6 characters')}}</strong></p>
      </div>


      <script>
          var myInput = document.getElementById("inputPassword");
          var letter = document.getElementById("letter");
          var capital = document.getElementById("capital");
          var number = document.getElementById("number");
          var length = document.getElementById("length");
          var symbol = document.getElementById("symbol");

          // When the user clicks on the password field, show the message box
          myInput.onfocus = function() {
              document.getElementById("message").style.display = "block";
          }

          // When the user clicks outside of the password field, hide the message box
          myInput.onblur = function() {
              document.getElementById("message").style.display = "none";
          }

          // When the user starts to type something inside the password field
          myInput.onkeyup = function() {
              // Validate lowercase letters
              var lowerCaseLetters = /[a-z]/g;
              if(myInput.value.match(lowerCaseLetters)) {
                  letter.classList.remove("invalid");
                  letter.classList.add("valid");
              } else {
                  letter.classList.remove("valid");
                  letter.classList.add("invalid");
              }

              // Validate capital letters
              var upperCaseLetters = /[A-Z]/g;
              if(myInput.value.match(upperCaseLetters)) {
                  capital.classList.remove("invalid");
                  capital.classList.add("valid");
              } else {
                  capital.classList.remove("valid");
                  capital.classList.add("invalid");
              }

              // Validate numbers
              var numbers = /[0-9]/g;
              if(myInput.value.match(numbers)) {
                  number.classList.remove("invalid");
                  number.classList.add("valid");
              } else {
                  number.classList.remove("valid");
                  number.classList.add("invalid");
              }

              //validate symbol
              var symbols = /[#?!@()$%^&*=_{}[\]:;"'|\\<>,.\/~`±§+-]/g;
              if(myInput.value.match(symbols)){
                  symbol.classList.remove("invalid");
                  symbol.classList.add("valid");
              } else {
                  symbol.classList.remove("valid");
                  symbol.classList.add("invalid");
              }

              // Validate length
              if(myInput.value.length >= 6) {
                  length.classList.remove("invalid");
                  length.classList.add("valid");
              } else {
                  length.classList.remove("valid");
                  length.classList.add("invalid");
              }


          }
      </script>


    <div class="form-group mt-1 col-md-6">
      <label class="form_text required" for="inputPassword4">{{__('confirm password')}}</label>
      <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
             name="password_confirmation" id="inputPassword2"  value="{{ old('password_confirmation') }}">


      @if ($errors->has('password'))
          <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('password') }}</strong>
          </span>
        @endif

    </div>

   {{--
      <div class="form-group col-md-6">
          <label class="form_text required">{{__('referral code')}}

              <a href="#" data-toggle="modal" data-target="#myModal" > <i class="fas fa-question-circle explainer_icon_style"></i> </a>

                @include('explainers.referral-code-explainer')


          </label>
          <input type="text" name="referralCode" class="form-control {{ $errors->has('referralCode') ? ' is-invalid' : '' }}"
                 value="{{ old('referralCode') }}" >
          @if ($errors->has('referralCode'))
              <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('referralCode') }}</strong>
          </span>
          @endif

      </div>
      --}}


        <div class="pl-2 col-md-6 mt-2">
          <label  class="form_text required mt-2"> {{__('gender')}} </label>

          <div class="form-check">
              <input class="form-check-input {{ $errors->has('gender') ? ' is-invalid' : '' }}" type="radio" name="gender"  value="m" {{ old('gender')=="m" ?'checked':''}} >
              <label class="form-check-label">{{__('male')}} </label>
          </div>

          <div class="form-check mt-2">
              <input class="form-check-input {{ $errors->has('gender') ? ' is-invalid' : '' }}" type="radio" name="gender" value="f" {{ old('gender')=="f" ?'checked':''}} >
              <label class="form-check-label">{{__('female')}}</label>

              @if ($errors->has('gender'))
                  <span class="invalid-feedback" role="alert">
                   <strong>{{ $errors->first('gender') }}</strong>
                  </span>
              @endif
         </div>

      </div>



      <div class="pl-2 col-md-6 mt-2">
          <label  class="form_text required mt-2"> {{__('language of correspondence')}} </label>

          <div class="form-check">
              <input class="form-check-input {{ $errors->has('language') ? ' is-invalid' : '' }}" type="radio" name="language"  value= "en" {{ old('language')=="en" ?'checked':''}} >
              <label class="form-check-label" for="exampleRadios1">{{__('english')}} </label>
          </div>

          <div class="form-check mt-2">
              <input class="form-check-input {{ $errors->has('language') ? ' is-invalid' : '' }}" type="radio" name="language" value="fr" {{ old('language')=="fr" ?'checked':''}} >
              <label class="form-check-label" for="exampleRadios2">{{__('french')}}</label>

              @if ($errors->has('language'))
                  <span class="invalid-feedback" role="alert">
                   <strong>{{ $errors->first('language') }}</strong>
                  </span>
              @endif
         </div>

      </div>




  </div>
  <button type="submit" class="btn btn-success btn-block my-5 buttons_style"> <i class="fas fa-user-plus"></i> {{__('register')}}</button>

    <a class="btn btn-link mb-5" href="{{ route('user.login') }}" style="text-decoration: none; font-size:17px;">
        {{__('already have an account')}} ? {{__('log in')}}

    </a>
</form>

</div>
</div>

@endsection

@section('scripts')


    @include('js-snippets.password-hide-show')

@endsection
