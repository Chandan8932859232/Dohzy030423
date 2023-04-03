

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">{{__('what is the referral code')}}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                {{__('this is the code that allows you to create an account and carry out transactions')}}.
                @if ( env('APP_ENV')=='prod' || env('APP_ENV')=='stage' )
                    {{__('this code was sent to you by email or text')}}. {{__('if you do not have one please')}} <a href="{{route('request.referral-code')}}"><u style="color:#5f5fd4">{{__('request a referral code')}}</u></a>
                @endif
                {{--
                @if ( env('APP_ENV')=='beta')
                    This code is included in the email that was sent to you with instructions to test out the site
                @endif
                --}}

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('close')}}</button>
            </div>

        </div>
    </div>
</div>


