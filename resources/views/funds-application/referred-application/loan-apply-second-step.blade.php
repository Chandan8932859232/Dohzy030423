@extends ('layouts.user')

@section('title', 'Apply For Funds')

@section('content')


     <div class="row">

        <div class="col-md-8 offset-sm-0">
            <h3 class="text-center mt-3 form_title">{{__('apply for a loan')}} : Payment Schedule </h3>
            <hr>

            <div class="container mt-4 mb-4">
                <div class="card bg-light text-dark">
                    <div class="card-body">
                        <p class="ml-3"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('money will be sent to you by')}} <strong>{{__('interac etransfer')}}</strong></p>
                        <p class="ml-3"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('you need a')}}<strong> {{__('referral code')}}</strong> {{__('to apply for a loan')}}. {{__('if you do not have one please')}} <a href="{{route('request.referral-code')}}"><u style="color:#5f5fd4">{{__('request a referral code')}}</u></a></p>
                    </div>
                </div>
            </div>

            <div class="container">

                <form method="post" action="{{route('funds-apply.store')}}" >
                    @csrf

                  <div class="form-row">  


           
                            

                </div>

                    <button type="submit" id="loanApply" class="btn btn-primary mt-4 mb-4 buttons_style">
                      {{__('next step')}} <i class="fas fa-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>

   {{--@include('notes.loan-apply-notes')--}}



    </div>


@endsection


@section('scripts')
    <script>
     
    


    </script>
@endsection
