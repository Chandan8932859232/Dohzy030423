
@extends('layouts.user')

@section('title', 'User Dashboard')

@section('content')

    @inject('loanMetric', 'App\Services\LoanService')
    @inject('user', 'App\Models\User')
    @inject('userMetric','App\Http\Controllers\UserLoanMetricsController')
    @inject('wallet', 'App\Models\Wallet')
<style>

.dashboard_tagline_text {
    color: #312A5C;
    font-size: 40px;
    font-weight: 900;
    padding-top: 20px;
    padding-left: 513px;
    word-spacing: 20px;

}
.dashboard_header{
    background:url('images/dashboard-image-desktop.png');
    background-repeat: no-repeat;
    background-size:100% 100%;
    /*height:350px;*/
}
</style>


    <div class="jumbotron jumbotron-fluid dashboard_header">
   
        <p class="dashboard_tagline_text">{{ __('fast simple reliable') }} </p>
    </div>


   {{-- <div class="container"> --}}

   {{-- <div class="jumbotron jumbotron-fluid dashboard_slide" >


    </div> --}}
{{-- </div> --}}



<!--
    <div class="dashboard_tagline">
        <p class="text-center" style="font-size:25px;font-weight: 700; color:#312A5C; padding-bottom:10px;"> {{__('we provide rapid financial')}} {{__('help in times of need')}} </p>
        <p class="text-center"><a class="btn  btn-outline-success btn-lg text-white slide_buttons" href="{{route('funds-apply.create')}}" role="button"> {{__('apply for a loan')}}</a></p>
        <br>
        <hr>
    </div>
-->



    <div class="container pt-4">



{{--

        <div class="mt-5 mb-4">
            <div class="card text-dark" style="background-color:white;">
                <div class="card-body">
                  <p class="ml-3"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('money will be sent to you by')}} <strong>{{__('interac etransfer')}}</strong></p>
                  <p class="ml-3"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('your loan range is')}} : <strong>${{$loanMetric->getLoanRange($user->getUserId())[0]}} - ${{$loanMetric->getLoanRange($user->getUserId())[1]}}</strong> </p>
                  <p class="ml-3"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('money will be sent to you by')}} <strong>{{__('interac etransfer')}}</strong></p>
                </div>
            </div>
        </div>


        <div class="container">
            <h2>Toggleable Tabs</h2>
            <br>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#menu1">Menu 1</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#menu2">Menu 2</a>
              </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <div id="home" class="container tab-pane active"><br>
                <h3>HOME</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
              </div>
              <div id="menu1" class="container tab-pane fade"><br>
                <h3>Menu 1</h3>
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
              </div>
              <div id="menu2" class="container tab-pane fade"><br>
                <h3>Menu 2</h3>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
              </div>
            </div>
          </div>

--}}




        <div class="card-columns mr-2">



            <div class="card ml-2 mb-5 mt-4" style="background-color:#ffffff;">
                <div class="card-body">
                    <p class="card-title text-center"> <span style="font-size:18px; color:#312A5C;">{{__('dohzy score')}}</span>

                        <a href="#" data-toggle="modal" data-target="#myScoreModal">  <i class="fas fa-question-circle explainer_icon_style"></i> </a>
                        @include('explainers.dohzy-score-explainer')

                    </p>
                     {{--
                    <p class="card-text" style="color:#685EA6; font-size: 23px; font-weight:500; text-align: center;">
                        {{$metrics->rank}}
                        @if($metrics->rank==10)
                            <span style="color:#ffc107;"><i class="fas fa-long-arrow-alt-up fa-xs"></i> </span>
                        @elseif($metrics->rank >10)
                            <span style="color:#28a745;"><i class="fas fa-long-arrow-alt-up fa-xs"></i> </span>
                        @elseif($metrics->rank < 10)
                            <span style="color:#dc3545;"><i class="fas fa-long-arrow-alt-up fa-xs"></i> </span>
                        @endif

                    </p> --}}

                    @if($metrics->rank == 10)
                       <p class="text-center"> <h5 class="text-center"><span class="badge badge-warning" style="background-color: #FFC107; "> <span class="badge badge-light mr-1 ml-1">  {{$metrics->rank}} </span>  {{__('average')}} </span> </h5> </p>


                    @elseif($metrics->rank > 24)
                       <p class="text-center"> <h5 class="text-center"><span class="badge badge-success" style="background-color: #009175;"> <span class="badge badge-light mr-1">  {{$metrics->rank}} </span>  {{__('exceptional')}} </span> </h5> </p>


                    @elseif($metrics->rank > 19 && $metrics->rank < 25)
                       <p class="text-center"> <h5 class="text-center"><span class="badge badge-success" style="background-color: #009175;"> <span class="badge badge-light mr-1">  {{$metrics->rank}} </span>  {{__('excellent')}}</span> </h5> </p>


                    @elseif($metrics->rank > 14 && $metrics->rank < 20)
                       <p class="text-center"> <h5 class="text-center"><span class="badge badge-success" style="background-color: #009175;"> <span class="badge badge-light mr-1">  {{$metrics->rank}} </span>  {{__('very good')}}</span> </h5> </p>


                    @elseif($metrics->rank > 10 && $metrics->rank < 15)
                       <p class="text-center"> <h5 class="text-center"><span class="badge badge-success" style="background-color: #009175;"> <span class="badge badge-light mr-1">  {{$metrics->rank}} </span>  {{__('good')}}</span> </h5> </p>


                    @elseif($metrics->rank > 5 && $metrics->rank < 10)
                       <p class="text-center"> <h5 class="text-center"><span class="badge badge-warning" style="background-color: #DC3545; color:white;"> <span class="badge badge-light mr-1">  {{$metrics->rank}} </span>  {{__('poor')}}</span> </h5> </p>


                    @elseif($metrics->rank > 0 && $metrics->rank < 6)
                       <p class="text-center"> <h5 class="text-center"><span class="badge badge-warning" style="background-color: #DC3545; color:white;"> <span class="badge badge-light mr-1">  {{$metrics->rank}} </span>  {{__('very poor')}}</span> </h5> </p>


                    @elseif( empty($metrics->rank))
                      <p class="text-center"> <h5 class="text-center"><span class="badge badge-dark"> {{__('very poor')}}</span> </h5> </p>
                    @endif






                </div>
            </div>


          {{--
            <div class="card ml-2 ml-2 mb-5 mt-4" style="background-color:#ffffff;">
                <div class="card-body">
                    <p class="card-title text-center"> <span style="font-size:18px; color:#312A5C;"> Account ID </span></p>
                    <p class="card-text" style="color:#312A5C; font-size: 23px; font-weight:500; text-align: center;">{{$user->getUserAccountId()}}</p>
                </div>
            </div>
            --}}


            <div class="card ml-2 ml-2 mb-5 mt-4" style="background-color:#ffffff;">
                <div class="card-body">
                    <p class="card-title text-center"><span style="font-size:18px; color:#312A5C;">{{__('loan balance')}} </span> </p>
                    <p class="card-text" style="color:#312A5C; font-size: 23px; font-weight:500; text-align: center;">${{number_format($userMetric->getUserLoansTotal($user->getUserId()))}}</p>
                </div>
            </div>

            <div class="card ml-2 ml-2 mb-5 mt-4" style="background-color:#ffffff;">
                <div class="card-body">
                    <p class="card-title text-center"> <span style="font-size:18px; color:#312A5C;;">{{__('loan span')}} </span>

                        <a href="#" data-toggle="modal" data-target="#myLoanRangeModal">  <i class="fas fa-question-circle explainer_icon_style"></i> </a>
                        @include('explainers.loan-range-explainer')

                    </p>

                    <p class="card-text" style="color:#312A5C; font-size: 23px; font-weight:500; text-align: center;">${{number_format($loanMetric->getLoanRange($user->getUserId())[0])}} - ${{number_format($loanMetric->getLoanRange($user->getUserId())[1])}} </p>
                </div>
            </div>

          {{--

            <div class="card ml-2 ml-2 mb-5 mt-4" style="background-color:#ffffff;">
                <div class="card-body">
                    <p class="card-title text-center" > <span style="font-size:18px; color:#312A5C;;">{{__('payment due date')}}</span></p>

                    <p class="card-text" style="color:#312A5C; font-size: 23px; font-weight:500; text-align: center;">
                        {{$userMetric->getRecentLoanPaymentDueDate($user->getUserId())}}
                        @if(!$userMetric->getRecentLoanPaymentDueDate($user->getUserId()))
                        NA
                        @endif
                    </p>
                </div>
            </div>
            --}}


            {{--
                       <div class="card bg-light">
                           <div class="card-body">
                               <p class="card-title text-center"><span style="font-size:18px; color:#000000;"><i class="fas fa-university"></i> Loan Balance </span> </p>
                               <p class="card-text" style="color:#685EA6; font-size: 23px; font-weight:500; text-align: center;">${{$userMetric->getUserLoansTotal($user->getUserId())}}</p>
                           </div>
                       </div>


                       <div class="card bg-light">
                           <div class="card-body">
                               <p class="card-title text-center"> <span style="font-size:18px; color:#000000;"> <i class="fas fa-medal"></i> Dohzy Score</span>

                                   <a href="#" data-toggle="modal" data-target="#myScoreModal">  <i class="fas fa-question-circle explainer_icon_style"></i> </a>
                                    @include('explainers.dohzy-score-explainer')

                               </p>

                               <p class="card-text" style="color:#685EA6; font-size: 23px; font-weight:500; text-align: center;">
                                   {{$metrics->rank}}
                                   @if($metrics->rank==10)
                                     <span style="color:#ffc107;"><i class="fas fa-long-arrow-alt-up fa-xs"></i> </span>
                                       @elseif($metrics->rank >10)
                                       <span style="color:#28a745;"><i class="fas fa-long-arrow-alt-up fa-xs"></i> </span>
                                       @elseif($metrics->rank < 10)
                                       <span style="color:#dc3545;"><i class="fas fa-long-arrow-alt-up fa-xs"></i> </span>
                                   @endif



                               </p>
                           </div>
                       </div>
                       --}}





            <div class="card ml-2 ml-2 mb-5 mt-4" style="background-color:#ffffff;">
                <div class="card-body">
                    <p class="card-title text-center"><span style="font-size:18px; color:#312A5C;"> {{__('wallet balance')}} </span></p>

                     <p class="card-text" style="color:#312A5C; font-size:23px; font-weight:500; text-align:center;">
                      @if($user->userHasWallet($user->getUserId()))
                        ${{$wallet->getWalletBalance($user->getUserId())}}
                      @endif

                      @if(!$user->userHasWallet($user->getUserId()))
                            NA
                      @endif
                     </p>
                </div>
             </div>



             <div class="card ml-2 ml-2 mb-5 mt-4" style="background-color:#ffffff;">
                <div class="card-body">
                    <p class="card-title text-center"> <span style="font-size:18px; color:#312A5C;"> {{__('base interest rate')}} </span>

                        <a href="#" data-toggle="modal" data-target="#myInterestExplainModal">  <i class="fas fa-question-circle explainer_icon_style"></i> </a>
                        @include('explainers.interest-rate-explainer')

                    </p>
                    <p class="card-text" style="color:#312A5C; font-size: 23px; font-weight:500; text-align: center;">{{$metrics->interest_rate}}%</p>
                </div>
            </div>




             <div class="card ml-2 ml-2 mb-5 mt-4" style="background-color:#ffffff;">
                <div class="card-body">
                    <p class="card-title text-center"> <span style="font-size:18px; color:#312A5C;">{{__('wait time between loans')}} </span>

                        <a href="#" data-toggle="modal" data-target="#myLoanWaitPeriodModal">  <i class="fas fa-question-circle explainer_icon_style"></i> </a>
                        @include('explainers.loan-wait-period-explainer')

                    </p>
                    <p class="card-text" style="color:#312A5C; font-size: 23px; font-weight:500; text-align: center;">{{$metrics->time_between_loans}} {{__('days')}}</p>
                </div>
            </div>


     {{--
          <div class="card ml-2 ml-2 mb-5 mt-4">
            <div class="card-body">
                <p class="card-title text-center"><span style="font-size:18px; color:#312A5C;">  {{ __('account type')}} </span></p>

                <p class="card-text" style="color:#312A5C; font-size: 22px; font-weight:500; text-align: center;">

                    @if($user->getUserType() ==1)
                         <strong><i class="fas fa-user"></i> {{__('personal')}}</strong>
                    @endif

                    @if($user->getUserType() ==2)
                        <strong><i class="fa-regular fa-users"></i> {{__('group member')}}</strong>
                    @endif

                    @if($user->getUserType() ==3)
                        <strong><i class="fa-regular fa-earth-africa"></i> {{__('africa based user')}}</strong>
                    @endif

                    @if($user->getUserType() ==4)
                        <strong><i class="fa-regular fa-briefcase"></i> {{__('business')}}</strong>
                    @endif


                </p>
            </div>
         </div>

        --}}





        </div>



    </div>

@endsection




<!--page specific scripts -->
@section('scripts')


{{--
<!-- check if session exist before displaying pop up. this is used to display pop just once(one page) load -->
@if(!session()->has('connectedUserModal'))
   <script>
	$(document).ready(function(){
		$("#connectedUserPopUpInfo").modal('show');
	});
   </script>

 {{ session()->put('connectedUserModal','shown') }} <!--put value into session so that after pop displays once its not displayed again -->

 <div class="modal" id="connectedUserPopUpInfo">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header text-center">
                <h3 class="modal-title" style="color:#312A5C;">{{__('welcome to Dohzy')}}</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>


            <div class="modal-body">

                <div class="card bg-white text-dark border-0">

                    <div class="card-body">

                        <h5> {{__('please note the following')}}</h5>

                        <p class="ml-3 mr-1 mt-4"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('after completely repaying a loan, you have to wait for at least')}} <strong>{{__('1 week')}}</strong>  {{__('before applying for another loan')}}</p>

                    </div>

                </div>

            </div>


            <div class="modal-footer">
                 <button type="button" class="btn btn-danger close_button_design" data-dismiss="modal">{{__('close')}}</button>
            </div>

        </div>
    </div>
 </div>


 @endif --}}

 @endsection
