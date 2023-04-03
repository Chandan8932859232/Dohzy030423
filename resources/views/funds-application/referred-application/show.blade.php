@extends ('layouts.user')

@section('title', 'Loan Details')

@section('content')

    @inject('loan', 'App\Services\LoanService')
    @inject('timeZoneConversion', 'App\Services\DateTimeService')


    <div class="row">
        <div class="col-sm-8 offset-sm-1">
            <h3 class="text-center mt-2">{{__('loan details')}}</h3>
            <div>

                <form action="#" method="post" >
                    @csrf
                    <table class="table">
                        <tr>

                        <tr>
                            <td><strong>{{__('status')}}</strong></td>
                            <td>
                                <span class="badge badge-primary"> {{$loan->getApplicationStatus($loanRequest->application_status)}}</span>
                            </td>
                        </tr>

                        <tr>
                            <td><strong>{{__('amount borrowed')}}</strong></td>
                            <td>${{$loanRequest->application_amount}}</td>
                        </tr>

                     @if($loan->isLoanCharged($loanRequest->id))
                        <tr> <br>
                            <td><strong>{{__('total charges')}}</strong> <br>

                                <a href="#" data-toggle="modal" data-target="#chargesBreakdownModal" class="btn btn-outline-dark btn-sm mt-3 mb-1"> <i class="fas fa-eye"></i> charges breakdown</a>
                                @include('explainers.charges-breakdown-explainer', ['loanId' => $loanRequest->id])

                            </td>

                            <td>${{$loan->getTotalChargesForALoan($loanRequest->id)}}</td>
                        </tr>
                      @endif

                        <tr>
                            <td><strong>{{__('loan balance')}} </strong></td>
                            <td>${{$loanRequest->balance}}</td>
                        </tr>

                        <tr>
                            @if($loanRequest->installment_payback_status==1)
                             <td><strong>{{__('amount per installment')}}</strong></td>
                             <td>${{$loan->getPayInstallmentAmounts($loanRequest->id)}}</td>
                           @endif
                        </tr>

                        <tr>
                            <td><strong>{{__('receive etransfer password')}}</strong></td>
                            <td>{{$loanRequest->send_interac_password}}</td>
                        </tr>

                       <tr>
                         <td><strong>{{__('request date')}} </strong></td>
                         <td> {{$timeZoneConversion->convertTimeToEST($loanRequest->created_at)}} </td>
                       </tr>

                        <tr>

                          @if($loanRequest->installment_payback_status==0)
                            <td><strong>{{__('payback deadline')}}</strong></td>
                            <td>{{$loanRequest->applicant_proposed_pay_back_date}}</td>
                           @endif

                        </tr>

                        @if($loanRequest->installment_payback_status==1)
                         <tr>
                          <td><strong>{{__('number of installments')}}</strong></td>
                          <td>{{$loan->getNumberOfInstallments($loanRequest->id)}}</td>
                         </tr>

                         <tr>
                          <td><strong>{{__('payback dates')}}</strong></td>
                          <td>{{$loan->getPayBackDates($loanRequest->id)}}</td>
                         </tr>
                        @endif

                        <tr>
                            <td><strong>{{__('payback interac email')}}</strong></td>
                            <td>{{$loanRequest->application_interact_email}}</td>
                        </tr>

                    {{--
                   <tr>
                       <td><strong>Payback interac eTransfer password</strong></td>
                       <td>{{$loanRequest->receive_interac_password}}</td>
                   </tr>
                    --}}

                   <tr>
                       <td><strong>{{__('interest rate')}}</strong></td>
                       <td>{{$loanRequest->interest_rate}}% </td>
                   </tr>

                   <tr>
                    <td><strong>{{__('loan id')}}</strong></td>
                    <td>{{$loanRequest->id}} </td>
                  </tr>
                   {{--
                   <tr>
                       <td><strong>{{__('your interac eTransfer autodeposit status')}}</strong></td>
                       <td>
                           @if($loanRequest->application_interact_autodeposit_status == 0)
                              {{__('no')}}
                           @endif
                           @if($loanRequest->application_interact_autodeposit_status == 1)
                              {{__('yes')}}
                           @endif
                       </td>
                   </tr> --}}

                   {{--
                   <tr>
                       <td><strong>Referral Code</strong></td>
                       <td>{{$loanRequest->application_referral_code}}</td>
                   </tr>
                   --}}

                   <br>



               </table>

               <a type="button" href="{{route('user-applications.index',$loanRequest->applicant_user_id)}}"
                  class="btn btn-outline-dark mt-4"> <i class="fas fa-arrow-left"></i>
                   {{__('back to loans')}}
               </a>

               {{--
               <button type="submit" class="btn btn-outline-success"><i class="fas fa-check"></i> Approve</button>

               <a type="button" href="{{route('user-applications.edit',$loanRequest->id)}}"
                  class="btn btn-outline-primary"> <i class="fas fa-edit text-primary"></i> Edit Loan </a>

               <a type="button" href="{{route('loan.payback',$loanRequest->id)}}"
                  class="btn btn-outline-info"> <i class="fas fa-eye text-primary"></i> Payback Info </a>

               <a type="button" href="{{route('user-application.delete',$loanRequest->id)}}"
                  class="btn btn-outline-danger" onclick="return confirm('Are you sure ? this will permanently delete the request')">
                   <i class="fas fa-trash-alt"></i> Cancel Loan</a>
                --}}
                </form>

            </div>
        </div>
    </div>


@endsection
