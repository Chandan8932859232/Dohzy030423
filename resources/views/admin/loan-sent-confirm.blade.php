@extends ('layouts.admin')

@section('title', 'Loan Sent')

@section('content')

    <div class="row">

        <div class="col-md-8 offset-sm-1">
            <h3 class="text-center mt-5">{{__('Confirm Money Sent')}} </h3>

            <div class="card">
                <div class="card-body">
                    <strong><i class="fas fa-info-circle"></i> Confirming Money Sent Will Do The Following</strong>
                    <ul><li> Send a money sent confirmation email to the user with transfer credentials</li>
                        <li> Send a money sent text message to the user with transfer credentials </li>
                        <li> Change the state of the loan to money sent </li>
                    </ul>
                </div>
            </div>

            <hr>

            <div class="container">

                <form method="post" action="{{route('admin.confirm-loan-sent')}}">
                    @csrf

                    <div class="form-row">


                        <div class="form-group col-md-6 mt-4">

                            <label class="form_text">Loan Id</label>
                            <input type="text"  name="loanId"
                                   value="{{old('loanId', $loanInfo->id)}}"
                                   class="form-control {{ $errors->has('requestAmount') ? ' is-invalid' : '' }}" readonly/>

                            @if ($errors->has('loanId'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('loanId') }}</strong>
                           </span>
                            @endif

                        </div>


                        <div class="form-group col-md-6 mt-4">

                            <label class="form_text">{{__('amount sent')}}($CAD)  </label>
                            <input type="text"  name="amountSent"
                                   value="{{old('amountSent', $loanInfo->application_amount)}}"
                                   class="form-control {{ $errors->has('amountSent') ? ' is-invalid' : '' }}" />

                                  @if ($errors->has('amountSent'))
                                       <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('amountSent') }}</strong>
                                       </span>
                                  @endif
                        </div>


                        <div class="form-group col-md-6 mt-4">

                            <label class="form_text">{{__('money transfer method')}}</label>
                            <input type="text"  name="moneyTransferMethod"
                                   value="{{old('moneyTransferMethod', 'interac eTransfer')}}"
                                   class="form-control {{ $errors->has('moneyTransferMethod') ? ' is-invalid' : '' }}" />

                            @if ($errors->has('moneyTransferMethod'))
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('moneyTransferMethod') }}</strong>
                               </span>
                            @endif

                        </div>



                        <div class="form-group col-md-6 mt-4">

                            <label class="form_text">{{__('interac eTransfer')}} {{__('password')}}</label>
                            <input type="text"  name="interacPassword"
                                   value="{{old('interacPassword', $loanInfo->send_interac_password)}}"
                                   class="form-control {{ $errors->has('interacPassword') ? ' is-invalid' : '' }}" />

                            @if ($errors->has('interacPassword'))
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('interacPassword') }}</strong>
                               </span>
                            @endif

                        </div>



                        <button type="submit" class="btn btn-dark btn-block mt-4 mb-5 ">
                            <i class="far fa-paper-plane"></i> {{__('Confirm Money Sent')}}
                        </button>
                </form>
            </div>
        </div>






    </div>


@endsection



