
@extends('layouts.investor')

@section('title', 'Investor Dashboard')

@section('content')

    @inject('loanMetric', 'App\Services\LoanService')
    @inject('user', 'App\Models\User')
    @inject('userMetric','App\Http\Controllers\UserLoanMetricsController')
    @inject('wallet', 'App\Models\Wallet')



    <div class="jumbotron jumbotron-fluid dashboard_header">
        <p class="dashboard_tagline_text">{{ __('fast simple reliable') }} </p>
    </div>



    <div class="container pt-4">

        <div class="card-columns mr-2">



            <div class="card ml-2 mb-5 mt-2" style="background-color:#ffffff;">
                <div class="card-body">
                    <p class="card-title text-center"> <span style="font-size:18px; color:#312A5C;">{{__('dohzy score')}}</span>

                        <a href="#" data-toggle="modal" data-target="#myScoreModal">  <i class="fas fa-question-circle explainer_icon_style"></i> </a>
                        @include('explainers.dohzy-score-explainer')

                    </p>

                </div>
            </div>


            <div class="card ml-2 ml-2 mb-5 mt-2" style="background-color:#ffffff;">
                <div class="card-body">
                    <p class="card-title text-center"><span style="font-size:18px; color:#312A5C;">{{__('loan balance')}} </span> </p>
                    <p class="card-text" style="color:#312A5C; font-size: 23px; font-weight:500; text-align: center;">
                    </p>
                </div>
            </div>

            <div class="card ml-2 ml-2 mb-5 mt-2" style="background-color:#ffffff;">
                <div class="card-body">
                    <p class="card-title text-center"> <span style="font-size:18px; color:#312A5C;;">{{__('loan span')}} </span>

                        <a href="#" data-toggle="modal" data-target="#myLoanRangeModal">  <i class="fas fa-question-circle explainer_icon_style"></i> </a>
                        @include('explainers.loan-range-explainer')

                    </p>

                    <p class="card-text" style="color:#312A5C; font-size: 23px; font-weight:500; text-align: center;"> </p>
                </div>
            </div>

            <div class="card ml-2 ml-2 mb-5 mt-2" style="background-color:#ffffff;">
                <div class="card-body">
                    <p class="card-title text-center" > <span style="font-size:18px; color:#312A5C;;">{{__('payment due date')}}</span></p>

                    <p class="card-text" style="color:#312A5C; font-size: 23px; font-weight:500; text-align: center;">

                    </p>
                </div>
            </div>

            <div class="card ml-2 ml-2 mb-5 mt-2" style="background-color:#ffffff;">
                <div class="card-body">
                    <p class="card-title text-center"> <span style="font-size:18px; color:#312A5C;"> {{__('base interest rate')}} </span>

                        <a href="#" data-toggle="modal" data-target="#myInterestExplainModal">  <i class="fas fa-question-circle explainer_icon_style"></i> </a>
                        @include('explainers.interest-rate-explainer')

                    </p>
                    <p class="card-text" style="color:#312A5C; font-size: 23px; font-weight:500; text-align: center;">
                    </p>
                </div>
            </div>





            <div class="card ml-2 ml-2 mb-5 mt-2" style="background-color:#ffffff;">
                <div class="card-body">
                    <p class="card-title text-center"><span style="font-size:18px; color:#312A5C;"> {{__('wallet balance')}} </span></p>

                     <p class="card-text" style="color:#312A5C; font-size:20px; font-weight:500; text-align:center;">



                     </p>
                </div>
             </div>





        </div>



    </div>

@endsection




<!--page specific scripts -->
@section('scripts')



{{-- check if session exist before displaying pop up. this is used to display pop just once(one page) load --}}
@if(!session()->has('connectedUserModal'))
   <script>
	$(document).ready(function(){
		$("#connectedUserPopUpInfo").modal('show');
	});
   </script>

 {{ session()->put('connectedUserModal','shown') }} {{--put value into session so that after pop displays once its not displayed again --}}

 <div class="modal" id="connectedUserPopUpInfo">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h3 class="modal-title" style="color:#312A5C;">{{__('welcome to Dohzy')}}</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

             <!-- Modal body -->
            <div class="modal-body">

                <div class="card bg-white text-dark border-0">

                    <div class="card-body">

                        <h5> {{__('please note the following')}}</h5>

                        <p class="ml-3 mb-3 mt-4 mr-1"> <i class="fas fa-arrow-circle-right site_points"></i> <strong>{{__('august 25 2022')}},</strong> {{__('due to high demand, all new users that are interested in loans and created an account as of')}} {{__('will automatically go on waiting list. We shall contact you to let you know when we can offer you a loan. The maximum waiting time is')}} <strong>{{__('1 week')}} </strong></p>

                        <p class="ml-3 mr-1"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('after completely repaying a loan, you have to wait for at least')}} <strong>{{__('1 week')}}</strong>  {{__('before applying for another loan')}}</p>

                    </div>

                </div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                 <button type="button" class="btn btn-danger close_button_design" data-dismiss="modal">{{__('close')}}</button>
            </div>

        </div>
    </div>
 </div>

 @endif

 @endsection
