@extends ('layouts.user')

@section('title', 'Review Loan')

@section('content')


    <div class="row">
        <div class="col-sm-8 offset-sm-1">
            <h3 class="text-center mt-2 form_title">{{__('review loan')}}</h3>
            <div>

                <form action="{{route('loan-apply.save')}}" method="post" >

                    <button type="submit"   class="btn btn-success buttons_style float-right mr-1 mt-3">
                        <i class="fas fa-paper-plane"></i> {{__('submit loan application')}}
                    </button>

                    @csrf
                    <table class="table mb-4 mt-2">


                        <tr>
                            <td>{{__('amount requested')}}</td>
                            <td><strong>${{session('amountRequested')}}</strong></td>
                        </tr>

                        <tr>
                            <td>{{__('when will you like to receive money from us')}}</td>
                            <td><strong>{{session('receiveMoneyDate')}}</strong></td>
                        </tr>

                        <tr>
                            <td>{{__('payback amount')}}</td>
                            <td><strong>${{session('loanPayBackAmount')}}</strong></td>
                        </tr>


                        @if(session('numberOfInstallments')==2)

                         <tr>
                            <td>{{__('amount per installment')}}</td>
                            <td><strong>${{session('amountPerInstallment')}}</strong></td>
                         </tr>

                         <tr>
                            <td>{{__('number of installments')}}</td>
                            <td><strong>{{session('numberOfInstallments')}}</strong></td>
                         </tr>

                         <tr>
                            <td>{{__('first installment payback date')}}</td>
                            <td><strong>{{session('firstInstallmentPayBackDate')}}</strong></td>
                         </tr>

                         <tr>
                            <td>{{__('second installment payback date')}}</td>
                            <td><strong>{{session('secondInstallmentPayBackDate')}}</strong></td>
                         </tr>

                        @endif

                        @if(session('numberOfInstallments')==3)

                        <tr>
                           <td>{{__('amount per installment')}}</td>
                           <td><strong>${{session('amountPerInstallment')}}</strong></td>
                        </tr>

                        <tr>
                            <td>{{__('number of installments')}}</td>
                            <td><strong>{{session('numberOfInstallments')}}</strong></td>
                         </tr>

                        <tr>
                           <td>{{__('first installment payback date')}}</td>
                           <td><strong>{{session('firstInstallmentPayBackDate')}}</strong></td>
                        </tr>

                        <tr>
                           <td>{{__('second installment payback date')}}</td>
                           <td><strong>{{session('secondInstallmentPayBackDate')}}</strong></td>
                        </tr>

                        <tr>
                            <td>{{__('third installment payback date')}}</td>
                            <td><strong>{{session('thirdInstallmentPayBackDate')}}</strong></td>
                         </tr>

                       @endif

                       @if(session('numberOfInstallments')==1)
                         <tr>
                             <td>{{__('when can you pay back')}}</td>
                            <td><strong>{{session('payBackDate')['onlyPayBackDate']}}</strong></td>
                         </tr>
                       @endif

                        <tr>
                            <td>{{__('interest rate')}}</td>
                            <td><strong>{{session('userInterestRate')}}%</strong></td>
                        </tr>



                        <tr>
                            <td>{{__('money transfer method')}}</td>
                            <td>
                                <strong>
                                @if(session('loanSendMoneyMethod') == 1)
                                    {{__('interac etransfer')}}
                                @endif
                                </strong>
                            </td>
                        </tr>

                        <tr>
                            <td>{{__('email address for')}} {{__('interac etransfer')}}</td>
                            <td><strong>{{session('interacEmail')}}</strong></td>
                        </tr>

                     {{--
                        <tr>
                            <td>{{__('your interac eTransfer autodeposit status')}}</td>
                            <td>
                                <strong>
                                @if(session('autoDepositEnabled') == 0)
                                    {{__('no')}}
                                @endif
                                @if(session('autoDepositEnabled') == 1)
                                    {{__('yes')}}
                                @endif
                                </strong>
                            </td>
                        </tr>
                        --}}
                     {{--
                        <tr>
                            <td>{{__('referral code')}}</td>
                            <td><strong>{{session('userProvidedReferralCode')}}</strong></td>
                        </tr>
                        --}}
                        <hr>

                        <br><br>

                    </table>

                    <div class="row">
                        <div class="col-sm-6">

                    <a type="button" href="{{ url()->previous() }}" class="btn btn-outline-dark float-left mt-2 ml-1">
                        <i class="fas fa-arrow-left"></i> {{__('back')}}
                    </a>
                        </div>

                    <div class="col-sm-6">

                    <button type="submit"   class="btn btn-success buttons_style float-right mt-2 mr-1">
                        <i class="fas fa-paper-plane"></i> {{__('submit loan application')}}
                    </button>
                </div>

                    </div>


                </form>

            </div>
        </div>
    </div>


@endsection
