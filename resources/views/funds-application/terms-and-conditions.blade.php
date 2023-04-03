@extends('layouts.user')

@section('title', 'Banking Information')

@section('content')

    <div class="row">
        <div class="col-sm-8">

            <h3 class="text-center mt-3 form_title">{{__('terms and conditions')}}</h3>
            <hr>
            <div class="container">

                <form action="{{route('banking-info.provided')}}" method="POST">
                    <p class="mt-4">
                     {{__('you accept the following terms and conditions from Dohzy Inc')}}
                    <ul>
                        <li>{{__('loan amount')}}: <strong>${{$loanInfo->application_amount}}</strong></li>
                        <li>{{__('repay amount')}} : <strong>${{$loanInfo->balance}}</strong> </li>
                        <li>{{__('interest rate')}} : <strong>{{$loanInfo->interest_rate}}%</strong> </li>
                        <li>{{__('repay date')}}: <strong>{{$loanInfo->applicant_proposed_pay_back_date}}</strong></li>
                    </ul>
                    {{__('you also accept that dohzy inc can')}}
                    <ul>
                        <li>{{__('withdraw the amount of')}} <strong>${{$loanInfo->balance}}</strong> {{__('plus any other charges on or after')}} <strong>{{$loanInfo->applicant_proposed_pay_back_date}}</strong> </li>
                        <li>{{__('failure to payback the loan will lead to')}}</li>

                    </ul>

                    </p>

                    <a type="button" href="{{route('loan-terms.accept', ['loan_id'=>$loanInfo->id])}}"
                       class="btn btn-outline-success float-left mt-5"> <i class="far fa-thumbs-up"></i>
                        {{__('accept')}}
                    </a>

                    <a type="button" href="{{route('loan-terms.reject', ['loan_id'=>$loanInfo->id])}}"
                       class="btn btn-outline-danger float-right mt-5"> <i class="fas fa-thumbs-down"></i>
                       {{__('reject')}}
                    </a>

                </form>


            </div>

        </div>





    </div>

@endsection

<!--page specific scripts (script for datepicker) -->
@section('scripts')


@endsection
