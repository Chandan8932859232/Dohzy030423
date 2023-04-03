@extends ('layouts.admin')

@section('title', 'User Loan Details')

@section('content')

    @inject('loan', 'App\Services\LoanService')


    <div class="row">
        <div class="col-sm-8 offset-sm-1">

            <br>
            <span class="mt-4">

            <div class="btn-group">
                <button type="button" class="btn btn-outline-dark">Actions</button>
                <button type="button" class="btn btn-outline-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
                    <span class="caret"></span>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('admin.loan-approve', $loanInfo->id)}}"><i class="fas fa-check-square"></i> Approve Loan </a>
                    <a class="dropdown-item" href="{{ route('admin.loan-sent', $loanInfo->id)}}"><i class="fas fa-comments-dollar"></i> Confirm Money Sent </a>
                    {{--
                    <a class="dropdown-item" href="{{ route('applications.edit',$application->id)}}"><i class="fas fa-edit"></i> Edit Loans </a>
                    <a class="dropdown-item" href="#"><i class="fas fa-ban"></i> Reject loan</a>
                     --}}
                    <a class="dropdown-item" type="submit" onclick="return confirm('Are you sure ? this will delete the record permanently')"
                       href="{{ route('applications.destroy', $loanInfo->id)}}">
                        {{--
                        <form action="{{ route('applications.destroy', $application->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')">  </button>
                        </form>


                        <i class="far fa-trash-alt"></i> Cancel loan
                         --}}

                    </a>

                </div>
            </div>

                <span style="font-size: 25px; font-weight: bold; padding-left:35px;"> Loan Details </span>

            </span>

            <div>

                <form action="#" method="post" >
                    @csrf
                    <table class="table">
                        <tr>


                        <tr>
                            <td><strong>Loan Status</strong></td>
                            <td>{{$loan->getApplicationStatus($loanInfo->application_status)}}</td>
                        </tr>


                        <tr>
                            <td><strong>Amount Requested</strong></td>
                            <td>${{$loanInfo->application_amount}}</td>
                        </tr>

                        <tr>
                            <td><strong>Pay back Amount </strong></td>
                            <td>${{$loanInfo->balance}}</td>
                        </tr>

                        <tr>
                            <td><strong>Interest Rate</strong></td>
                            <td>{{$loanInfo->interest_rate}}% </td>
                        </tr>


                        @if($loan->isLoanCharged($loanInfo->id))
                        <tr> <br>
                            <td><strong>{{__('total charges')}}</strong> <br>

                                <a href="#" data-toggle="modal" data-target="#chargesBreakdownModal" class="btn btn-outline-dark btn-sm mt-3 mb-1"> <i class="fas fa-eye"></i> charges breakdown</a>
                                @include('explainers.charges-breakdown-explainer', ['loanId' => $loanInfo->id])

                            </td>

                            <td>${{$loan->getTotalChargesForALoan($loanInfo->id)}}</td>
                        </tr>
                       @endif

                        <tr>
                            <td><strong>Loan Type</strong></td>
                            <td>
                                @if($loanInfo->application_type == 1)
                                    Individual loan
                                @endif
                                @if($loanInfo->application_type == 3)
                                    Real Estate Assistance Loan
                                @endif
                                @if($loanInfo->application_type == 4)
                                    Business Assistance Loan
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td><strong>Receive Money Date </strong></td>
                            <td>{{$loanInfo->application_receive_money_date}}</td>
                        </tr>



                        @if($loan->repayInInstallmentsStatus($loanInfo->id))

                            <tr>
                              <td><strong>Pay back in installments </strong></td>
                              <td>Yes</td>
                            </tr>

                            <tr>
                              <td><strong>Number of installments </strong></td>
                              <td>{{$loan->getNumberOfInstallments($loanInfo->id)}}</td>
                            </tr>

                            <tr>
                              <td><strong>repayment amount per installments </strong></td>
                              <td>${{$loan->getPayInstallmentAmounts($loanInfo->id)}}</td>
                            </tr>

                              <td><strong>Installment dates </strong></td>
                              <td>{{$loan->getPayBackDates($loanInfo->id)}}</td>
                          </tr>
                        @else
                           <tr>
                              <td><strong>Pay back in installments </strong></td>
                              <td>No</td>
                            </tr>

                            <tr>
                              <td><strong>Pay back date </strong></td>
                              <td>{{$loanInfo->applicant_proposed_pay_back_date}}</td>
                           </tr>
                        @endif

                        </tr>

                        <tr>
                            <td><strong>Send Money interac email</strong></td>
                            <td>{{$loanInfo->application_interact_email}}</td>
                        </tr>

                        <tr>
                            <td><strong>Send Money interac eTransfer password</strong></td>
                            <td>{{$loanInfo->send_interac_password}}</td>
                        </tr>

                        <tr>
                            <td><strong>Payback interac eTransfer password</strong></td>
                            <td>{{$loanInfo->receive_interac_password}}</td>
                        </tr>

                        <tr>
                            <td><strong>interac eTransfer autodeposit status</strong></td>
                            <td>
                                @if($loanInfo->application_interact_autodeposit_status == 0)
                                    No
                                @endif
                                @if($loanInfo->application_interact_autodeposit_status == 1)
                                    Yes
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td><strong>Referral Code</strong></td>
                            <td>{{$loanInfo->application_referral_code}}</td>
                        </tr>

                        <br>

                    </table>

                    <a type="button" href="{{route('admin.loans')}}"
                       class="btn btn-outline-dark"> <i class="fas fa-arrow-left"></i>
                        Back To Loans
                    </a>

                </form>

            </div>
        </div>
    </div>


@endsection
