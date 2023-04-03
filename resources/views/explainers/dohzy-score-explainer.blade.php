

<!-- The Modal -->
<div class="modal" id="myScoreModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">{{__('what is a dohzy score')}} ? </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                {{__('the dohzy score is similar to a credit score.It is an indication of your credit reliability')}}
                 <strong> 1 - 30</strong>

                <ul class="mt-3">
                    <li class="score_explain mt-2">25 - 30   :  <span class="badge badge-success score_describe"> {{__('exceptional')}} </span> </li>
                    <li class="score_explain mt-2">20 - 24   :  <span class="badge badge-success score_describe"> {{__('excellent')}} </span> </li>
                    <li class="score_explain mt-2">15 - 19   :  <span class="badge badge-success score_describe"> {{__('very good')}} </span> </li>
                    <li class="score_explain mt-2">11 - 14   :  <span class="badge badge-success score_describe"> {{__('good')}} </span> </li>
                    <li class="score_explain mt-2">10   :  <span class="badge badge-warning score_describe"> {{__('fair')}} </span></li>
                    <li class="score_explain mt-2">6 - 9    :  <span class="badge badge-danger score_describe"> {{__('poor')}} </span></li>
                    <li class="score_explain mt-2">1 - 5    :  <span class="badge badge-danger score_describe"> {{__('very poor')}} </span></li>
                </ul>
                {{__('when you start using the system, you will be assigned a score of 10')}}

                <p class="mt-3"> <strong>{{__('a high dohzy score leads to the following')}}</strong> </p>

                <ul>
                    <li>{{__('a high loan approval rate')}}</li>
                    <li>{{__('faster processing time for request')}}</li>
                    <li>{{__('qualification for the real estate assistance loan')}}</li>
                </ul>

                <strong>{{__('principal factors that affect dohzy Score')}}</strong>
                <ul>
                    <li>{{__('timely loan repayments')}}</li>
                </ul>


            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
