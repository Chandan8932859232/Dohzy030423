@extends ('layouts.user')

@section('title', 'Withdraw Funds')


@section('content')

@inject('wallet', 'App\Models\Wallet')
@inject('user', 'App\Models\User')

<h1 class="mt-3 ml-3 form_title"> {{__('withdraw funds')}} </h1>

    <div class="row">

        <div class="col-md-8 offset-sm-0">


            <div class="container mt-5 mb-4">
                <div class="card  text-dark">
                    <div class="card-body">
                        <p class="ml-3"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('your wallet balance is')}} : <span style='color:#312A5C; font-weight:bold;'>${{ $wallet->getWalletBalance($user->getUserId()) }}</span></p>
                        <p class="ml-3"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('the funds will be sent by')}} : <span style='color:#312A5C; font-weight:bold;'>{{__('interac etransfer')}}</span></p>
                        <p class="ml-3"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('maximum amount of time to receive funds')}} : <span style= 'color:#312A5C; font-weight:bold;'> {{__('24 hours')}}</span></p>

                    </div>
                </div>
            </div>


            @include('forms.withdraw-from-wallet')



        {{-- @include('notes.real-estate-loan-notes') --}}



    </div>


@endsection


@section('scripts')


@endsection
