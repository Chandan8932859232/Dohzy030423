@extends('layouts.user')

@section('title', 'Usage Statistics')

@section('content')

    @inject('loanMetric', 'App\Services\LoanService')
    @inject('user', 'App\Models\User')
    @inject('userMetric','App\Http\Controllers\UserLoanMetricsController')

    <h3 class="mt-2 mb-4 ml-2" style="color:#251F4F; font-weight: 800; font-size:26px;">{{__('usage statistics')}} </h3>

    <div class="container">

    <div class="card-columns mr-2">

        <div class="card bg-light">
            <div class="card-body text-center">
                <h5 class="card-title" style="color:#000000;"><i class="fas fa-university"></i> {{__('loan balance')}}</h5>
                <p class="card-text" style="color:#685EA6; font-size: 23px; font-weight:500;">${{$userMetric->getUserLoansTotal($user->getUserId())}}</p>
            </div>
        </div>

        <div class="card bg-light">
            <div class="card-body text-center">
                <h5 class="card-title" style="color:#000000;"> <i class="fas fa-hand-holding-usd"></i> {{__('loan span')}}</h5>
                <p class="card-text" style="color:#685EA6; font-size: 23px; font-weight:500;">${{$loanMetric->getLoanRange($user->getUserId())[0]}} - ${{$loanMetric->getLoanRange($user->getUserId())[1]}} </p>
            </div>
        </div>

        <div class="card bg-light">
            <div class="card-body text-center">
                <h5 class="card-title" style="color:#000000;"><i class="far fa-calendar-alt"></i> {{__('payment due date')}}</h5>
                <p class="card-text" style="color:#685EA6; font-size: 23px; font-weight:500;">{{$userMetric->getRecentLoanPaymentDueDate($user->getUserId())}}
                @if(!$userMetric->getRecentLoanPaymentDueDate($user->getUserId()))
                    NA
                    @endif
                </p>
            </div>
        </div>

    </div>

  </div>


@endsection
