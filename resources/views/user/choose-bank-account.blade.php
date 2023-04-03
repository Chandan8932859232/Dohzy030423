
@extends('layouts.user')

@section('title', 'Bank Accounts')

@section('content')

    @inject('loanService', 'App\Services\LoanService')

    <h2 class="display-5 mt-4 mb-5 ml-3" style="color:#251F4F; font-size: 25px; font-weight:500;"> {{__('choose bank account')}}</h2>

    <div class="container mt-2 mb-5">
        <div class="card bg-white text-dark">
            <div class="card-body">
                <h3 style="color:#251F4F; font-size:19px; font-weight:500; margin-bottom:20px;"> {{__('the banking information will be used for')}} </h3>

                <p class="ml-3 mb-2 mt-2"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('taking out the loan repayment on the agreed upon payback day')}}</li>
                <p class="ml-3 mb-2"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('depositing the loan into your account')}}</li>

            </div>
        </div>
    </div>

    <br>

    <div class="container">


        @if(count($userBankAccounts) > 0 )

            @foreach($userBankAccounts as $userBankAccount)

                <div class="container">
                    <div class="card bg-white mb-5">
                        <div class="card-header">
                            <h3 style="color:#251F4F; font-size: 21px; font-weight:500;"><i class="fas fa-university"></i> {{__('bank account')}}</h3>
                        </div>

                        <div class="card-body">

                            <p class="card-text"><span class="metric"> {{__('institution number')}} :</span> {{$userBankAccount->institution_number}}</p>
                            <p class="card-text"><span class="metric"> {{__('branch number')}} :</span> {{$loanService->trimBankInfo($userBankAccount->transit_number)}} </p>
                            <p class="card-text"><span class="metric"> {{__('account number')}} :</span> {{$loanService->trimBankInfo($userBankAccount->account_number)}}</p>


                            @switch($userBankAccount->institution_number)

                                @case(\App\Models\BankAccountInformation::RBC_INSTITUTION_NUMBER)
                                <p class="card-text"><span class="metric"> {{__('institution name')}} :</span>  <img src="{{ asset('images/rbc-logo-2.png') }}" width="21px" height="18px"
                                                                                                                                                                       alt="RBC Logo"> RBC  </p>
                                <hr class="mt-3 mb-3">

                                <a class="card-link" href="{{route('bank-account-choosen.process',['bank_id'=>$userBankAccount->id])}}">
                                    <button type="button" class="btn btn-dohzy buttons_style">
                                        {{__('use this account')}}
                                    </button>
                                </a>
                                @break

                                @case(\App\Models\BankAccountInformation::BMO_INSTITUTION_NUMBER)
                                <p class="card-text"><span class="metric"> {{__('institution name')}} :</span> <img src="{{ asset('images/bmo-logo.jpeg') }}" width="21px" height="18px"
                                                                                                                                                                        alt="BMO Logo"> BMO </p>
                                <hr class="mt-3 mb-3">

                                <a class="card-link" href="{{route('bank-account-choosen.process',['bank_id'=>$userBankAccount->id])}}">
                                    <button type="button" type="submit"  class="btn btn-dohzy buttons_style">
                                       {{__('use this account')}}
                                    </button>
                                </a>
                                @break


                                @case(\App\Models\BankAccountInformation::SCOTIA_INSTITUTION_NUMBER)
                                <p class="card-text"><span class="metric"> {{__('institution name')}} :</span>  <img src="{{ asset('images/scotia-logo.png') }}" width="21px" height="18px"
                                                                                                                                                                 alt="Scotia Logo"> Scotia</p>
                                <hr class="mt-3 mb-3">
                                <a class="card-link" href="{{route('bank-account-choosen.process',['bank_id'=>$userBankAccount->id])}}">
                                    <button type="button" class="btn btn-dohzy buttons_style">
                                        <i class="far fa-check-circle"></i> {{__('use this account')}}
                                    </button>
                                </a>
                                @break


                                @case(\App\Models\BankAccountInformation::TD_INSTITUTION_NUMBER)
                                <p class="card-text"><span class="metric"> {{__('institution name')}} :</span>   <img src="{{ asset('images/td-logo.png') }}" width="21px" height="18px"
                                                                                                                                                            alt="TD Logo"> TD </p>
                                <hr class="mt-3 mb-3">
                                <a class="card-link" href="{{route('bank-account-choosen.process',['bank_id'=>$userBankAccount->id])}}">
                                    <button type="button" class="btn btn-dohzy buttons_style">
                                        {{__('use this account')}}
                                    </button>
                                </a>
                                @break


                                @case(\App\Models\BankAccountInformation::CIBC_INSTITUTION_NUMBER)
                                <p class="card-text"><span class="metric"> {{__('institution name')}} :</span>  <img src="{{ asset('images/CIBC_logo.svg') }}" width="21px" height="18px"
                                                                                                                                                          alt="CIBC Logo"> CIBC </p>
                                <hr class="mt-3 mb-3">
                                <a class="card-link" href="{{route('bank-account-choosen.process',['bank_id'=>$userBankAccount->id])}}">
                                    <button type="button" class="btn btn-dohzy buttons_style">
                                         {{__('use this account')}}
                                    </button>
                                </a>
                                @break


                                @case(\App\Models\BankAccountInformation::DESJARDIN_INSTITUTION_NUMBER)
                                <p class="card-text"><span class="metric"> {{__('institution name')}} :</span>  <img src="{{ asset('images/desjardins-logo.jpeg') }}" width="21px" height="18px"
                                                                                                                                                            alt="CIBC Logo"> Desjardins </p>
                                <hr class="mt-3 mb-3">
                                <a class="card-link" href="{{route('bank-account-choosen.process',['bank_id'=>$userBankAccount->id])}}">
                                    <button type="button" class="btn btn-dohzy buttons_style">
                                         {{__('use this account')}}
                                    </button>
                                </a>
                                @break


                                @default
                                <p class="card-text"><span class="metric"> {{__('institution name')}} :</span> {{__('unknown')}}</p>
                                <hr class="mt-3 mb-3">
                                <a class="card-link" href="{{route('bank-account-choosen.process',['bank_id'=>$userBankAccount->id])}}">
                                    <button type="button" class="btn btn-success buttons_style">
                                         {{__('use this account')}}
                                    </button>
                                </a>

                            @endswitch


                        </div>
                    </div>

                </div>



            @endforeach

            <div class="float-center">
                {{$userBankAccounts->links()}} {{-- print pagination links --}}
            </div>


                <div>
                     {{--
                    <a type="button" href=""
                       class="btn btn-outline-dark float-right mr-2">
                        <i class="fas fa-plus"></i> {{__('add new bank account')}}
                    </a>
                    --}}
                    <br><br>
                    <a type="button" href="{{route('user-applications.index',$userBankAccount->user_id)}}"
                       class="btn btn-outline-dark float-left ml-1">
                        <i class="fas fa-arrow-left"></i> {{__('back to loans')}}
                    </a>

                </div>



        @else
            <div class="card">
                <h2 class="card-body text-center" style="color:#251F4F; font-size: 24px; font-weight:600;">{{__('no bank accounts exist')}}</h2>
            </div>

             <br><br>

            <a type="button" href="{{route('user-applications.index',$userBankAccount->user_id)}}"
               class="btn btn-outline-dark float-center ml-1 mt-5">
                <i class="fas fa-arrow-left"></i> {{__('back to loans')}}
            </a>


        @endif



            <br><br><br><br><br> <br><br><br><br>
     @endsection


