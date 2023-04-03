@extends('layouts.user')

@section('title', 'Bank Accounts')

@section('content')

    <style>
        input[type='radio'] {
            height: 18px;
            width: 18px;
        }
    </style>

    <div class="row">
        <div class="col-sm-12">

            <h2 class="text-center mt-3 form_title">{{__('banking information')}}</h2>
            <hr class="mb-2">

            <div class="card">

                <div class="card-header"> <h4 style="color:#251F4F; font-size:14px; font-weight: 600;">
                        <i class="fas fa-info-circle"></i> {{__('the banking information will be used for')}}
                    </h4>
                </div>

                <div class="card-body">
                    <ul>
                        <li> {{__('taking out the loan repayment on the agreed upon payback day')}}</li>
                        <li> {{__('depositing the loan into your account')}}</li>
                    </ul>

                </div>
            </div>

            <h3 class="display-5 mt-4 mb-4">{{__('choose bank account')}}</h3>

             <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                    <tr style="font-weight: bold; background-color:#9b94cd; color:white;">


                        <td>{{__('institution number')}}</td>
                        <td>{{__('institution name')}}</td>
                        <td>{{__('branch number')}}</td>
                        <td>{{__('account number')}}</td>
                    </tr>
                    </thead>

                    <tbody>

                    <form>
                    @if(count($userBankAccounts) > 0 )
                    @foreach($userBankAccounts as $userBankAccount)

                        <tr>
                            {{--<td> <input type="radio"> </td> --}}

                            <td> <label><input type="radio" name="optradio"> {{$userBankAccount->institution_number}}</label></td>

                            <td>
                                @switch($userBankAccount->institution_number)

                                   @case(\App\Models\BankAccountInformation::RBC_INSTITUTION_NUMBER)
                                    <img src="{{ asset('images/rbc-logo-2.png') }}" width="21px" height="18px"
                                         alt="RBC Logo"> RBC
                                   @break

                                   @case(\App\Models\BankAccountInformation::BMO_INSTITUTION_NUMBER)
                                           <img src="{{ asset('images/bmo-logo.jpeg') }}" width="21px" height="18px"
                                                alt="BMO Logo"> BMO
                                    @break

                                    @case(\App\Models\BankAccountInformation::SCOTIA_INSTITUTION_NUMBER)
                                           <img src="{{ asset('images/scotia-logo.png') }}" width="21px" height="18px"
                                                alt="Scotia Logo"> Scotia
                                    @break

                                    @case(\App\Models\BankAccountInformation::TD_INSTITUTION_NUMBER)
                                           <img src="{{ asset('images/td-logo.png') }}" width="21px" height="18px"
                                                alt="TD Logo"> TD
                                    @break

                                    @case(\App\Models\BankAccountInformation::CIBC_INSTITUTION_NUMBER)
                                           <img src="{{ asset('images/CIBC_logo.svg') }}" width="21px" height="18px"
                                                alt="CIBC Logo"> CIBC
                                    @break

                                       @case(\App\Models\BankAccountInformation::DESJARDIN_INSTITUTION_NUMBER)
                                           <img src="{{ asset('images/desjardins-logo.jpeg') }}" width="21px" height="18px"
                                                alt="CIBC Logo"> Desjardins
                                       @break
                                    @default
                                      {{__('unknown')}}

                                @endswitch


                            </td>

                            <td>
                                {{$userBankAccount->transit_number}}
                            </td>

                            <td>
                                {{$userBankAccount->account_number}}
                            </td>

                        </tr>

                    @endforeach

                    </form>

                    </tbody>
                </table>


                <div class="float-right">
                {{$userBankAccounts->links()}} <!-- print pagination links -->
                </div>
             </div>


             <div>

                 <a type="button" href="{{route('banking.information')}}"
                    class="btn btn-outline-dark float-right mr-2">
                     <i class="fas fa-plus"></i> {{__('add new bank account')}}
                 </a>

                 <a type="button" href="{{--{{route('loan.terms',['loan_id'=>$loanInfo->id])}}--}}"
                    class="btn btn-dohzy float-left ml-1">
                     <i class="far fa-paper-plane"></i> {{__('submit and continue loan request')}}
                 </a>

             </div>

            @else
                <h2>No Applications exist as of now </h2>

            @endif

        </div>  </div>

    <br><br><br><br><br>

@endsection

