@extends ('layouts.user')

@section('title', 'Interac Information')

@section('content')

@inject('user', 'App\Models\User')



    <div class="row">

        <div class="col-md-8 offset-sm-0">


            <div class="container mt-2 mb-5">
                <div class="card  text-dark">
                    <div class="card-body">
                        <h3 style="color:#251F4F; font-size:19px; font-weight:500; margin-bottom:20px;"> {{__('how to contribute to tontine')}} ? </h3>

                        <p class="ml-3 mb-3 mt-2"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('send an interac eTransfer to')}} <strong><span style="font-size:16px; color:#312A5C;">pay@dohzy.com </span></strong> ( {{__('please note the password')}} )</p>
                        <p class="ml-3 mb-3"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('send the interac information through the form below')}} </p>
                    </div>
                </div>
             </div>


            <h3 class="text-center mt-4 form_title">{{__('send interac information')}} </h3>
            <hr>
            <div class="container">

                <form method="post" action="{{route('process.contribution')}}">
                    @csrf

                    <div class="form-row">

                        <div class="col-md-12 mt-3">
                            <label class="form_text required">{{__('amount sent')}}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$CAD</span>
                                </div>
                                <input type="text" name="amountSent" class="form-control {{ $errors->has('amountSent') ? ' is-invalid' : '' }}"
                                       value="{{old('amountSent')}}" placeholder="">

                                @if ($errors->has('amountSent'))
                                    <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('amountSent') }}</strong>
                                </span>
                                @endif

                            </div>
                        </div>


                        <div class="form-group col-md-12 mt-3">
                            <label class="form_text required" >{{__('date sent')}} </label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i> </span>
                                </div>

                                <input type="text" data-date-format="yyyy-mm-dd" id="datepickerPaidBackDate" name="sentMoneyDate"
                                       value="{{old('sentMoneyDate')}}"
                                       class="form-control {{ $errors->has('sentMoneyDate') ? ' is-invalid' : '' }}" />

                                @if ($errors->has('sentMoneyDate'))
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('sentMoneyDate') }}</strong>
                           </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-md-12 mt-3">

                            <label class="form_text required">{{__('password')}} {{__('for')}} {{__('interac etransfer')}}</label>
                            <input type="text"  name="interacPassword" value="{{old('interacPassword')}}"
                                   class="form-control {{ $errors->has('interacPassword') ? ' is-invalid' : '' }}" />

                            @if ($errors->has('interacPassword'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('interacPassword') }}</strong>
                           </span>
                            @endif

                        </div>

                    </div>

                    <button type="submit" class="btn btn-success my-5  float-left buttons_style">
                        <i class="far fa-paper-plane"></i> {{__('send interac information')}}
                    </button>


                    <a class="card-link" href="{{route('tontine.index', ['user_id'=> $user->getUserId()])}}">
                        <button type="button" class="btn btn-outline-dark float-right my-5">
                            <i class="fas fa-arrow-left"></i> {{__('back to tontine')}}
                        </button>
                    </a>


                </form>
            </div>
        </div>
       <br><br>

       {{-- @include('notes.loan-payback-notes') --}}
    </div>


@endsection

@section('scripts')

    @include('js-snippets.date-picker')

@endsection
