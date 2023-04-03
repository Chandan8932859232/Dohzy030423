
 @inject('loanService', 'App\Services\LoanService')

<!-- The Modal -->
<div class="modal" id="chargesBreakdownModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">{{__('charges breakdown')}}  </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">


              <br>

                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr style="font-weight: bold; background-color:#8a84a6; color:white;">
                            <td>{{__('charge type')}}</td>
                            <td>{{__('amount')}}</td>

                        </tr>
                        </thead>
                        <tbody>
                     @php
                     $loanCharges = $loanService->getAllChargesForALoan($loanId)
                     @endphp

                     @if(count($loanCharges) > 0 )    <!-- check if applications exist then loop through -->
                        @foreach($loanCharges as $loanCharge)
                            <tr>

                                <td>{{$loanService->chargeTypeShow($loanCharge->charge_type)}}</td>
                                <td>${{$loanCharge->amount}}</td>

                            </tr>
                        @endforeach
                      @endif

                      <tr>

                        <td><span style="font-size: 17px; color:#312A5C; font-weight:bold;">{{__('total charges')}}</span></td>
                        <td><span style="font-size: 17px; color:#312A5C; font-weight:bold;">${{$loanService->getTotalChargesForALoan($loanId)}} </span></td>

                    </tr>

                        </tbody>

                    </table>

                </div>














            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
