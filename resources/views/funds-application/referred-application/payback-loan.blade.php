@extends ('layouts.user')

@section('title', 'Loan Details')

@section('content')

    @push('page_specific_style')
        <link href="{{ asset('css/specific_styles/copy-to-clipboard.css') }}" rel="stylesheet">
    @endpush


    <div class="row">

        <div class="col-md-8 offset-sm-0">
            <h3 class="text-center mt-3 form_title">{{__('submit payment information')}} </h3>
            <hr>
            <div class="container">

                <form method="post" action="{{route('loan-pay-back.handle', $loanRequest->id)}}">
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

                            <label class="form_text required">{{--{{__('answer')}}/--}}{{__('password')}} {{__('for')}} {{__('interac etransfer')}}
                            <!--  <button onclick="copyTextFunction()"> Copy text</button> -->
                            </label>
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
                        <i class="far fa-paper-plane"></i> {{__('submit payment information')}}
                    </button>



                    <a class="card-link" href="{{ route('unpaid.loans', $loanRequest->applicant_user_id) }}">
                        <button type="button" class="btn btn-outline-dark float-right my-5">
                            <i class="fas fa-arrow-left"></i> {{__('back to unpaid loans')}}
                        </button>
                    </a>

    
                </form>
            </div>
        </div>
       <br><br> 

        @include('notes.loan-payback-notes')
    </div>


@endsection

@section('scripts')

    @include('js-snippets.date-picker')
    @include('js-snippets.copy-to-clipboard')

@endsection
