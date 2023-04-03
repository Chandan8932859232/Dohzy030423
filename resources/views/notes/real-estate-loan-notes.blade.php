

<div class="col-md-4 mt-3">
    <div class="container">


        <div class="card bg-light mb-4">
            <div class="card-body">
                <p class="card-title text-center"> <span style="font-size:18px; color:#000000;"><i class="fas fa-chart-line"></i> {{__('interest rate')}} </span>

                    <a href="#" data-toggle="modal" data-target="#myInterestExplainModal">  <i class="fas fa-question-circle explainer_icon_style"></i> </a>
                    @include('explainers.interest-rate-explainer')

                </p>
                <p class="card-text" style="color:#685EA6; font-size: 23px; font-weight:500; text-align: center;">{{$metrics->interest_rate}}%</p>
            </div>
        </div>


        <div class="card bg-light mb-4">
            <div class="card-body">
                <p class="card-title text-center"> <span style="font-size:18px; color:#000000;"> <i class="fas fa-hand-holding-usd"></i> {{__('loan span')}} </span>

                    <a href="#" data-toggle="modal" data-target="#myLoanRangeModal">  <i class="fas fa-question-circle explainer_icon_style"></i> </a>
                    @include('explainers.loan-range-explainer')

                </p>

                <p class="card-text" style="color:#685EA6; font-size: 23px; font-weight:500; text-align: center;">$2,000 - $5000 </p>
            </div>
        </div>


    <ul class="list-group">
        <li class="list-group-item side_note_heading">
            <h5><i class="fas fa-exclamation-circle"></i> {{__('please note the following')}}</h5></li>
        {{--<li class="list-group-item"> <i class="fas fa-arrow-circle-right site_points"></i>
            {{__('money will be sent to you by')}} <strong>{{__('interac etransfer')}}</strong></li> --}}
        <li class="list-group-item"><i class="fas fa-arrow-circle-right site_points"></i>
            {{__('you have to approve a loan before the money is sent you')}}</li>
        <li class="list-group-item"><i class="fas fa-arrow-circle-right site_points"></i>
            {{__('if a loan is approved it takes about')}} <strong>{{__('24 hours')}}</strong> {{__('to receive funds')}} </li>
        <li class="list-group-item"><i class="fas fa-arrow-circle-right site_points"></i>
            {{__('you can cancel a loan request')}} <strong>{{__('5 hours')}}</strong> {{__('after you apply')}}</li>
    </ul>

    </div>
</div>


