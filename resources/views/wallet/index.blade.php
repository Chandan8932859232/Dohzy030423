@extends('layouts.user')

@section('title', 'Wallet')

@section('content')

@inject('wallet', 'App\Models\Wallet')
@inject('user', 'App\Models\User')


<h1 class="mt-3 ml-3 form_title">{{__('wallet')}}</h1>

<div class="col-md-8 offset-sm-0">

    <div class="container mt-5 mb-5">

        <div class="card wallet_balance_background_deco">

            <div class="card-body">


                <div class="row">

                   <div class="col-md-8">


                      <p style="color:#685EA6; font-size: 30px; font-weight:700;"> ${{ $wallet->getWalletBalance( $user->getUserId()) }} </p>
                      <p style="font-size:19px; color:#000000; font-weight:500; "> {{__('balance')}}</p>

                   </div>

                   <div class="col-md-4">


                    <a class="card-link" href="{{ route('wallet.withdraw') }}">
                        <button type="button" class="btn btn-success my-5  float-left buttons_style">
                             {{__('withdraw funds')}}
                        </button>
                    </a>

                  </div>

                </div>


            </div>

        </div>

    </div>

   <br>

    <div class="container">

        <h2 class="mt-5 mb-4 form_title">{{__('transaction history')}}</h2>



             @if(count($walletTransactions) > 0 )    <!-- check if transactions exist then loop through -->



             <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                    <tr style="font-weight: bold; background-color:#685EA6; color:white;">
                        <td>{{__('amount')}}</td>
                        <td>{{__('type')}}</td>
                        <td>{{__('date')}}</td>
                        {{--<td>{{__('reason')}}</td>--}}
                        <td>{{__('status')}}</td>
                        <td>{{__('balance')}}</td>
                    </tr>
                    </thead>
                    <tbody>



                 @foreach($walletTransactions as $walletTransaction )
                     <tr>
                        <td>${{$walletTransaction->amount}}</td>

                        <td>
                          @if($walletTransaction->type == \App\Models\WalletTransactions::DEBIT_TRANSACTION)
                             {{__('debit')}}
                          @endif

                          @if($walletTransaction->type == \App\Models\WalletTransactions::CREDIT_TRANSACTION)
                            {{__('credit')}}
                          @endif

                        </td>

                        <td>{{$walletTransaction->date}}</td>

                        {{--<td>{{$walletTransaction->reason}}</td>--}}

                        <td>
                          @if($walletTransaction->status == \App\Models\WalletTransactions::TRANSACTON_TO_BE_PROCESSED)
                            {{{__('to be processed')}}}
                          @endif

                          @if($walletTransaction->status == \App\Models\WalletTransactions::TRANSACTION_COMPLETE)
                            {{{__('complete')}}}
                          @endif


                        </td>

                        <td><strong>${{$walletTransaction->balance}}</strong></td>

                     </tr>
                 @endforeach
                     </tbody>
                   </table>


                   <div class="float-right">
                       {{$walletTransactions->links()}} <!-- print pagination links -->
                   </div>



            @else <!-- no wallet transactions -->
              <div class="card mt-5">
                  <h2 class="card-body text-center" style="color:#251F4F; font-size: 18px; font-weight:400;"> {{__('no wallet transactions exist')}} </h2>
              </div>

            @endif

            <br><br><br><br><br><br><br>
            <a type="button" href="{{url('/')}}"
                class="btn btn-outline-dark ml-1"> <i class="fas fa-arrow-left"></i>
                 {{__('back to home')}}
             </a>



             <br><br><br><br><br><br><br>

        </div>




    </div>


</div>




@endsection


@section('scripts')




@endsection
