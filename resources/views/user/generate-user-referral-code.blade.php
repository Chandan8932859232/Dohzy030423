@extends('layouts.user')

@section('title', __('generate referral code'))

@section('content')

    <div class="row">

        <div class="col-md-8 offset-sm-0">
            <h3 class="text-center mt-5 form_title">{{__('generate referral code')}} </h3>
            <hr class="mb-3">

            <div class="container">

        
                <form method="post" action="{{route('user.generate-referral-code')}}">
                    @csrf

                    <div class="form-row">

                      <div class="form-group col-sm-12">
                         <label class="form_text mt-3"> {{__('who referred you to dohzy or how did you hear about us')}} ? </label>
                          <input type="text" name="referrer" value="{{ old('referrer') }}"  class="form-control{{ $errors->has('referrer') ? ' is-invalid' : '' }} form-control-lg">
                          <small>{{__('if there answer is no one, you can write no one')}}</small>
                            @if ($errors->has('referrer'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('referrer') }}</strong>
                               </span>
                            @endif
                       </div>

                    </div>

                    <button type="submit" class="btn btn-success mt-3 mb-2 buttons_style">
                        <i class="fas fa-qrcode"></i> {{__('generate referral code')}}
                    </button>
                </form>
            </div>
        </div>

       

       {{-- @include('notes.recommend-user-notes') --}}



    </div>    
    
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>



    

@endsection


