@extends('layouts.user')

@section('title', 'Unpaid Loans')

@section('content')

    @inject('user', 'App\Models\User')


    <h2 class="display-5 mt-5 mb-5 ml-3" style="color:#251F4F; font-size: 25px; font-weight:500;">
        {{ __('your unpaid loans') }}</h2>

    <div class="container mt-2 mb-5">
        <div class="card text-dark notes_style">
            <div class="card-body">
                <h3 style="color:#251F4F; font-size:19px; font-weight:500; margin-bottom:20px;">
                    {{ __('how to repay a loan by interac eTransfer') }} </h3>

                <p class="ml-3 mb-3 mt-2"> <i class="fas fa-arrow-circle-right site_points"></i>
                    {{ __('send an interac eTransfer to') }} <strong><span
                            style="font-size:16px; color:#312A5C;">pay@dohzy.com </span></strong>
                    ({{ __('please note the password') }})</p>

                <p class="ml-3 mb-3"> <i class="fas fa-arrow-circle-right site_points"></i>
                    {{ __('log into dohzy and go to') }} </p>

                <p class="ml-3 mb-2"> <i class="fas fa-arrow-circle-right site_points"></i>
                    {{ __('on the repay loans page') }} </p>

            </div>
        </div>
    </div>

    <br>



    <div class="container">

        @if (count($unPaidLoans) > 0)

            @foreach ($unPaidLoans as $unPaidLoan)
                <div class="container">

                    <div class="card mb-5 loans_box_deco">

                        <div class="card-header" style="background-color: #ffffff;">
                            <h3 style="color:#251F4F; font-size: 22px; font-weight:500;"><img
                                    src="{{ asset('images/dohzy-favicon.png') }}" width="23px" height="23px"
                                    class="mb-1"> {{ __('loan information') }}</h3>
                        </div>

                        <div class="card-body" style="background-color: #ffffff;">
                            <div class="row">

                                <div class="col-md-6">

                                    <p class="card-text"><span class="metric"> {{ __('payback amount') }} :</span> <span
                                            class="data_of_metric"> ${{ number_format($unPaidLoan->balance) }} </span> </p>
                                    <p class="card-text"><span class="metric"> {{ __('burrowed amount') }} :</span> <span
                                            class="data_of_metric">${{ number_format($unPaidLoan->application_amount) }}</span>
                                    </p>
                                    <p class="card-text"><span class="metric"> {{ __('payback deadline') }} :</span><span
                                            class="data_of_metric"> {{ $unPaidLoan->applicant_proposed_pay_back_date }}
                                        </span> </p>
                                    <p class="card-text"><span class="metric"> {{ __('pay loan method') }} :</span> <span
                                            class="data_of_metric"> {{ __('interac etransfer') }}</span> </p>

                                </div>

                                <div class="col-md-6">
                                    @switch($unPaidLoan->application_status)
                                        @case(\App\Models\Loan::APPLICATION_APPROVED_AND_MONEY_SENT)
                                            <p class="card-text mt-2"><span class="metric"> {{ __('payment status') }} :</span>
                                                <span class="badge badge-warning metric"> {{ __('to be repaid') }} </span>
                                            </p>

                                            <hr class="mt-3 mb-3">

                                            <a class="card-link" href="{{ route('loan.payback', $unPaidLoan->id) }}">
                                                <button type="button" class="btn btn-success  mt-2 mb-2 buttons_style">
                                                    <i class="fas fa-comments-dollar"></i> {{ __('submit payment information') }}
                                                </button>
                                            </a>

                                            <a class="card-link" href="{{ route('user-applications.view', $unPaidLoan->id) }}">
                                                <button type="button" class="btn btn-outline-dark mt-2 mb-2 ">
                                                    <i class="fas fa-eye"></i> {{ __('loan details') }}
                                                </button>
                                            </a>
                                        @break

                                        @case(\App\Models\Loan::LOAN_PAYMENT_MADE_BUT_TO_BE_VERIFIED)
                                            <p class="card-text mt-2"><span class="metric"> {{ __('payment status') }} :</span>
                                                <span class="badge badge-warning metric"> {{ __('to be repaid') }} </span>
                                            </p>

                                            <hr class="mt-3 mb-3">

                                            <a class="card-link" href="{{ route('loan.payback', $unPaidLoan->id) }}">
                                                <button type="button" class="btn btn-success  mt-2 mb-2 buttons_style">
                                                    <i class="fas fa-comments-dollar"></i> {{ __('submit payment information') }}
                                                </button>
                                            </a>

                                            <a class="card-link" href="{{ route('user-applications.view', $unPaidLoan->id) }}">
                                                <button type="button" class="btn btn-outline-dark mt-2 mb-2 ">
                                                    <i class="fas fa-eye"></i> {{ __('loan details') }}
                                                </button>
                                            </a>
                                        @break

                                        @case(\App\Models\Loan::LOAN_REPAYMENT_IS_ONGOING)
                                            <p class="card-text mt-2"><span class="metric"> {{ __('payment status') }} :</span>
                                                <span class="badge badge-warning metric"> {{ __('to be repaid') }} </span>
                                            </p>

                                            <hr class="mt-3 mb-3">

                                            <a class="card-link" href="{{ route('loan.payback', $unPaidLoan->id) }}">
                                                <button type="button" class="btn btn-success  mt-2 mb-2 buttons_style">
                                                    <i class="fas fa-comments-dollar"></i> {{ __('submit payment information') }}
                                                </button>
                                            </a>

                                            <a class="card-link" href="{{ route('user-applications.view', $unPaidLoan->id) }}">
                                                <button type="button" class="btn btn-outline-dark mt-2 mb-2 ">
                                                    <i class="fas fa-eye"></i> {{ __('loan details') }}
                                                </button>
                                            </a>
                                        @break
                                    @endswitch

                                </div>




                            </div>
                        </div>
                    </div> <br><br><br>

                </div>
            @endforeach

            <div class="float-center">
                {{ $unPaidLoans->links() }} {{-- print pagination links --}}
            </div> <br><br>
        @else
            <div class="card">
                <h2 class="card-body text-center" style="color:#251F4F; font-size: 24px; font-weight:600;">
                    {{ __('no unpaid loans exist') }}</h2>
            </div>

        @endif


        <script>
            setTimeout('window.location.reload();', 30000);
        </script>
    </div>
@endsection
