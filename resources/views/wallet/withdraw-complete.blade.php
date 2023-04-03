@extends ('layouts.user')

@section('title', 'Withdraw Complete')

@section('content')

  @inject('user', 'App\Models\User')

    <div class="row">
        <div class="col-sm-8 offset-sm-1">

            <div class="jumbotron confirm_process_style">
                <h1 class="form_title text-success"> <i class="far fa-check-circle" style="color:#009175;"></i> <span style="color:#251F4F;">{{__('withdrawal is complete')}} </span></h1>
                <hr>
               

                    <p class="text-left ml-3 mt-5" style="font-size: 16px; font-weight: 500;"> <i class="fas fa-arrow-circle-right site_points"></i>
                   
                        {{__('the funds will be sent to you by interac etransfer within the next 24 hours')}}
                    </p>

             
                <a class="card-link" href="{{route('wallet.index', ['user_id'=> $user->getUserId()])}}">
                <button type="button" class="btn btn-outline-dark mt-5 mb-2">
                    <i class="fas fa-arrow-left"></i> {{__('back to wallet')}}
                </button>
                </a>


            </div>
        </div>

    </div>


@endsection
