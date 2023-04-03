
@extends('layouts.user')

@section('title', 'Loans')

@section('content')


    @inject('loanMetric', 'App\Services\LoanService')
    @inject('user', 'App\Models\User')
    @inject('userMetric','App\Http\Controllers\UserLoanMetricsController')


    @inject('timeZoneConversion', 'App\Services\DateTimeService')

    <h2 class="display-5 mt-3 mb-4 ml-4" style="color:#251F4F; font-size: 27px; font-weight:500;">{{__('your loans')}}</h2>


    <div class="container">


        {{--
        <div class="card bg-light">
            <div class="card-body text-center">
                <h5 class="card-title" style="color:#000000;"><i class="fas fa-university"></i> {{__('loan balance')}}</h5>
                <p class="card-text" style="color:#685EA6; font-size: 24px; font-weight:500;">${{$userMetric->getUserLoansTotal($user->getUserId())}}</p>
            </div>
        </div>

        <div class="card bg-light">
            <div class="card-body text-center">
                <h5 class="card-title" style="color:#000000;"><i class="far fa-calendar-alt"></i> {{__('payment due date')}}</h5>
                <p class="card-text" style="color:#685EA6; font-size: 24px; font-weight:500;">
                    {{$userMetric->getRecentLoanPaymentDueDate($user->getUserId())}}
                   @if(!$userMetric->getRecentLoanPaymentDueDate($user->getUserId()))
                       NA
                    @endif
                </p>
            </div>
        </div>

        <div class="card bg-light">
            <div class="card-body text-center">
                <h5 class="card-title" style="color:#000000;"> <i class="fas fa-hand-holding-usd"></i> {{__('loan span')}} </h5>
                <p class="card-text" style="color:#685EA6; font-size: 24px; font-weight:500;">${{$loanMetric->getLoanRange($user->getUserId())[0]}} - ${{$loanMetric->getLoanRange($user->getUserId())[1]}} </p>
            </div>
        </div>
        --}}


    <br>


    @if(count($userApplications) > 0 )


        @foreach($userApplications as $userApplication)

        <div class="container">

          <div class="card mb-5 loans_box_deco">

             <div class="card-header" style="background-color: #ffffff;">
                 <h3 style="color:#251F4F; font-size: 22px; font-weight:500;"><img src="{{ asset('images/dohzy-favicon.png') }}" width="23px" height="23px" class="mb-1"> {{__('loan information')}}</h3>
             </div>

          <div class="card-body" style="background-color: #ffffff;">

            <div class="row">

             <div class="col-md-6">

              <p class="card-text"><span class="metric"> {{__('loan balance')}} :</span> <span class="data_of_metric"> ${{number_format($userApplication->balance)}} </span> </p>
              <p class="card-text"><span class="metric"> {{__('amount borrowed')}} :</span> <span class="data_of_metric">${{number_format($userApplication->application_amount)}}</span></p>

              @if($userApplication->installment_payback_status==1)
              <p class="card-text"><span class="metric"> {{__('amount per installment')}} :</span><span class="data_of_metric">${{$loanMetric->getPayInstallmentAmounts($userApplication->id)}} </span> </p>
              @endif

              @if($userApplication->installment_payback_status==0)
              <p class="card-text"><span class="metric"> {{__('payback deadline')}} :</span><span class="data_of_metric"> {{$userApplication->applicant_proposed_pay_back_date}} </span> </p>
              @endif

              @if($userApplication->installment_payback_status==1)
               <p class="card-text"><span class="metric"> {{__('number of installments')}} :</span><span class="data_of_metric"> {{$loanMetric->getNumberOfInstallments($userApplication->id)}} </span> </p>
               <p class="card-text"><span class="metric"> {{__('payback dates')}} :</span><span class="data_of_metric"> {{$loanMetric->getPayBackDates($userApplication->id)}} </span> </p>
              @endif

              <p class="card-text"><span class="metric"> {{__('interest rate')}} :</span> <span class="data_of_metric">{{$userApplication->interest_rate}}% </span></p>
              <p class="card-text"><span class="metric"> {{__('money transfer method')}} :</span> <span class="data_of_metric"> {{__('interac etransfer')}}</span> </p>

             </div>

             <div class="col-md-6">

              @switch($userApplication->application_status)

                  @case(\App\Models\Loan::APPLICATION_RECEIVED)

                  <p class="card-text mt-2"><span class="metric"> {{__('status')}} :</span>
                      <span class="badge badge-primary metric" style="color:white; font-size:14px;"> {{__('request received')}}, {{__('to be processed')}} </span>
                  </p>

                  <hr class="mt-4 mb-4">

                  <a class="card-link" href="{{route('user-applications.view',$userApplication->id)}}">
                      <button type="button" class="btn btn-dohzy btn-sm">
                          <i class="fas fa-eye"></i> {{__('loan details')}}
                      </button>
                  </a>

                  <a class="btn btn-outline-danger btn-sm ml-2" href="{{route('user-application.delete',$userApplication->id)}}"
                     onclick="return confirm('{{__('are you sure of deleting')}}')" >
                     <i class="far fa-trash-alt"></i> {{__('cancel loan')}}
                  </a>
                  @break

                  @case(\App\Models\Loan::APPLICATION_IS_PROCESSING)

                  <p class="card-text mt-2"><span class="metric"> {{__('status')}} :</span>
                      <span class="badge badge-primary metric" style="color:white;"> {{__('request is being processed')}} </span>
                  </p>

                  <hr class="mt-4 mb-4">


                  <a class="card-link" href="{{route('user-applications.view',$userApplication->id)}}">
                      <button type="button" class="btn btn-dohzy btn-sm">
                          <i class="fas fa-eye"></i> {{__('loan details')}}
                      </button>
                  </a>

                  <a class="card-link" href="{{route('user-application.delete',$userApplication->id)}}"
                     onclick="return confirm('Are you sure ? this will permanently delete the request')">
                      <button type="button" class="btn btn-outline-danger btn-sm">
                          <i class="far fa-trash-alt"></i> {{__('cancel loan')}}
                      </button>
                  </a>
                  @break

                  @case(\App\Models\Loan::APPLICATION_AWAITING_USER_APPROVAL)


                  <p class="card-text mt-2"><span class="metric"> {{__('status')}}  :</span>
                      <span class="badge badge-warning metric"> {{__('pending user approval')}}</span>
                  </p>

                  <p class="text-muted mt-1">{{__('please click the button below to accept the loan')}} </p>

                  <hr class="mt-4 mb-4">

                  <a class="card-link" href="{{route('banking.information',$userApplication->id )}}">
                      <button type="button" class="btn btn-warning buttons_style">
                        <i class="spinner-grow spinner-grow-sm icon_color" style="size:3px;"></i>   {{__('accept loan')}}
                      </button>
                  </a>

                  <a class="card-link" href="{{route('user-application.delete',$userApplication->id)}}"
                     onclick="return confirm('Are you sure ? this will permanently delete the request')">
                      <button type="button" class="btn btn-outline-danger btn-sm">
                          <i class="far fa-trash-alt"></i> {{__('cancel loan')}}
                      </button>
                  </a>
                  @break

                  @case(\App\Models\Loan::APPLICATION_PROCESSED_AND_REJECTED)


                  <p class="card-text mt-2"><span class="metric"> {{__('status')}} :</span>
                      <span class="badge badge-danger metric" style="color:white;"> {{__('rejected')}}</span>
                  </p>

                  <hr class="mt-4 mb-4">

                  <a class="card-link" href="">
                      <button type="button" class="btn btn-outline-secondary btn-sm">
                          <i class="fas fa-eye"></i> {{__('refusal reasons')}}
                      </button>
                  </a>

                  <a class="card-link" href="{{route('user-applications.view',$userApplication->id)}}">
                      <button type="button" class="btn btn-dohzy btn-sm">
                          <i class="fas fa-eye"></i> {{__('loan details')}}
                      </button>
                  </a>
                  @break

                  @case(\App\Models\Loan::APPLICATION_APPROVED_AND_MONEY_WILL_BE_SENT)


                  <p class="card-text mt-2"><span class="metric"> {{__('status')}} :</span>
                      <span class="badge badge-success metric" style="color:white;"> {{__('approved')}}, {{__('money will be sent')}}</span>
                  </p>

                  <hr class="mt-4 mb-4">



                  <a class="card-link" href="{{route('user-applications.view',$userApplication->id)}}">
                      <button type="button" class="btn btn-dohzy btn-sm">
                          <i class="fas fa-eye"></i> {{__('loan details')}}
                      </button>
                  </a>

                  <a class="card-link" href="{{route('loan.payback',$userApplication->id)}}">
                    <button type="button" class="btn btn-dark btn-sm">
                        <i class="fas fa-dollar-sign"></i> {{__('payback loan')}}
                    </button>
                </a>

                  @break

                  @case(\App\Models\Loan::APPLICATION_APPROVED_AND_MONEY_SENT)

                  <p class="card-text mt-2"><span class="metric"> {{__('interac etransfer')}} {{__('password')}} :</span> <span class="data_of_metric">{{$userApplication->send_interac_password}}</span></p>

                  <p class="card-text"><span class="metric"> {{__('status')}} :</span>
                      <span class="badge badge-success metric" style="color:white;"> {{__('approved')}} , {{__('money sent')}} </span>
                  </p>

                  <hr class="mt-4 mb-4">

                  <a class="card-link" href="{{route('loan.payback',$userApplication->id)}}">
                      <button type="button" class="btn btn-dark btn-sm">
                          <i class="fas fa-dollar-sign"></i> {{__('payback loan')}}
                      </button>
                  </a>


                  <a class="card-link" href="{{route('user-applications.view',$userApplication->id)}}">
                      <button type="button" class="btn btn-dohzy btn-sm">
                          <i class="fas fa-eye"></i> {{__('loan details')}}
                      </button>
                  </a>
                  @break

                  @case(\App\Models\Loan::LOAN_PAYMENT_MADE_BUT_TO_BE_VERIFIED)

                  <p class="card-text mt-2"><span class="metric"> {{__('status')}} :</span>
                      <span class="badge badge-warning metric" style="color:#000000;">{{__('repayment submitted')}}, {{__('to be verified')}} </span>
                  </p>

                  <hr class="mt-4 mb-4">

                  <a class="card-link" href="{{route('user-applications.view',$userApplication->id)}}">
                      <button type="button" class="btn btn-dohzy btn-sm">
                          <i class="fas fa-eye"></i> {{__('loan details')}}
                      </button>
                  </a>
                  @break


                  @case(\App\Models\Loan::LOAN_COMPLETELY_REPAID)

                  <p class="card-text mt-2"><span class="metric"> {{__('status')}} :</span>
                      <span class="badge badge-dark metric" style="color:white;">{{__('loan is completely repaid')}}</span>
                  </p>

                  <hr class="mt-4 mb-4">

                  <a class="card-link" href="{{route('repayment-history.view',$userApplication->id)}}">
                    <button type="button" class="btn btn-success btn-sm">
                        <i class="fas fa-eye"></i> {{__('payment history')}}
                    </button>
                 </a>

                  <a class="card-link" href="{{route('user-applications.view',$userApplication->id)}}">
                      <button type="button" class="btn btn-dohzy btn-sm">
                          <i class="fas fa-eye"></i> {{__('loan details')}}
                      </button>
                  </a>

                  @break

                  @case(\App\Models\Loan::LOAN_TERMS_AND_CONDITIONS_REJECTED)

                  <p class="card-text mt-2"><span class="metric"> {{__('status')}} :</span>
                      <span class="badge badge-danger metric">{{__('loan terms rejected')}}</span>
                  </p>

                  <hr class="mt-4 mb-4">

                  <a class="card-link" href="{{route('user-application.delete',$userApplication->id)}}"
                     onclick="return confirm(__('are you sure of deleting'))">
                      <button type="button" class="btn btn-outline-danger btn-sm">
                          <i class="far fa-trash-alt"></i> {{__('cancel loan')}}
                      </button>
                  </a>

                  @break


                  @case(\App\Models\Loan::LOAN_REPAYMENT_IS_ONGOING)

                  <p class="card-text mt-2"><span class="metric"> {{__('status')}} :</span>
                      <span class="badge badge-warning metric" style="color:black;">{{__('repayment is on going')}}</span>
                  </p>

                  <hr class="mt-4 mb-4">

                  <a class="card-link my-2" href="{{route('repayment-history.view',$userApplication->id)}}">
                    <button type="button" class="btn btn-success btn-sm my-2">
                        <i class="fas fa-eye"></i> {{__('payment history')}}
                    </button>
                 </a>

                  <a class="card-link" href="{{route('loan.payback',$userApplication->id)}}">
                    <button type="button" class="btn btn-dark btn-sm my-2">
                        <i class="fas fa-dollar-sign"></i> {{__('payback loan')}}
                    </button>
                 </a>


                  <a class="card-link my-2" href="{{route('user-applications.view',$userApplication->id)}}">
                      <button type="button" class="btn btn-dohzy btn-sm my-2">
                          <i class="fas fa-eye"></i> {{__('loan details')}}
                      </button>
                  </a>

                  @break



                  @case(\App\Models\Loan::LOAN_IS_WITH_INTERNAL_COLLECTIONS)

                  <p class="card-text mt-2"><span class="metric"> {{__('status')}} :</span>
                      <span class="badge badge-danger metric" style="color:white;">{{__('loan is with internal collections')}}</span>
                  </p>

                  <hr class="mt-4 mb-4">

                  <a class="card-link my-2" href="{{route('repayment-history.view',$userApplication->id)}}">
                    <button type="button" class="btn btn-success btn-sm my-2">
                        <i class="fas fa-eye"></i> {{__('payment history')}}
                    </button>
                 </a>

                  <a class="card-link my-2" href="{{route('user-applications.view',$userApplication->id)}}">
                      <button type="button" class="btn btn-dohzy btn-sm my-2">
                          <i class="fas fa-eye"></i> {{__('loan details')}}
                      </button>
                  </a>

                  @break


                  @case(\App\Models\Loan::LOAN_IS_WITH_EXTERNAL_COLLECTIONS)

                  <p class="card-text mt-2"><span class="metric"> {{__('status')}} :</span>
                      <span class="badge badge-danger metric" style="color:white;">{{__('loan is with external collections')}}</span>
                  </p>

                  <hr class="mt-4 mb-4">

                  <a class="card-link my-2" href="{{route('repayment-history.view',$userApplication->id)}}">
                    <button type="button" class="btn btn-success btn-sm my-2">
                        <i class="fas fa-eye"></i> {{__('payment history')}}
                    </button>
                 </a>

                  <a class="card-link my-2" href="{{route('user-applications.view',$userApplication->id)}}">
                      <button type="button" class="btn btn-dohzy btn-sm my-2">
                          <i class="fas fa-eye"></i> {{__('loan details')}}
                      </button>
                  </a>

                  @break



                  @case(\App\Models\Loan::LOAN_WAS_RECOVERED_FROM_EXTERNAL_COLLECTIONS)

                  <p class="card-text mt-2"><span class="metric"> {{__('status')}} :</span>
                      <span class="badge badge-danger metric" style="color:white;">{{__('loan was recovered from external collections')}}</span>
                  </p>

                  <hr class="mt-4 mb-4">

                  <a class="card-link my-2" href="{{route('repayment-history.view',$userApplication->id)}}">
                    <button type="button" class="btn btn-success btn-sm my-2">
                        <i class="fas fa-eye"></i> {{__('payment history')}}
                    </button>
                 </a>

                  <a class="card-link my-2" href="{{route('user-applications.view',$userApplication->id)}}">
                      <button type="button" class="btn btn-dohzy btn-sm my-2">
                          <i class="fas fa-eye"></i> {{__('loan details')}}
                      </button>
                  </a>

                  @break




                  @default
                  <p class="card-text mt-2"><span class="metric"> {{__('status')}} :</span>
                      <span class="badge badge-warning metric" > {{__('unknown')}} </span>
                  </p>

                  <hr class="mt-4 mb-4">

                  <a class="card-link" href="#">
                      <button type="button" class="btn btn-outline-dark btn-sm">
                          <i class="fas fa-phone"></i> {{__('contact us')}}
                      </button>
                  </a>


                  <a class="card-link" href="{{route('user-applications.view',$userApplication->id)}}">
                      <button type="button" class="btn btn-outline-dohzy btn-sm">
                          <i class="fas fa-eye"></i> {{__('loan details')}}
                      </button>
                  </a>



               @endswitch


                </div>

            </div>


          </div>
        </div>

            </div>

            <br><br>

        @endforeach



            <div class="float-center">
            {{$userApplications->links()}} {{-- print pagination links --}}
            </div>
            <br><br>

        @else
            <div class="card">
              <h2 class="card-body text-center" style="color:#251F4F; font-size: 24px; font-weight:600;">{{__('no Loans exist')}}</h2>
            </div>



        @endif


    </div>

@endsection

    <!--page specific script(refreshes page on a given interval) -->
@section('scripts')
            <script>
                setTimeout('window.location.reload();', 20000);
            </script>
@endsection
