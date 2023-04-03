@extends ('layouts.user')

@section('title', 'Loan Complete')

@section('content')

    @inject('user', 'App\Models\User')

    <div class="row">
        <div class="col-sm-8 offset-sm-1">

            <div class="jumbotron confirm_process_style">
                <h1 class="form_title text-success"> <i class="far fa-check-circle" style="color:#009175;"></i> <span style="color:#251F4F;">{{__('your loan request is complete')}} </span></h1>
                <hr>
                <h4 class="mt-4 mb-2 ml-1" style="color:black;"> {{__('what are the next steps')}} ?</h4> <br>

                    <p class="text-left ml-3" style="font-size: 16px; font-weight: 500;"> <i class="fas fa-arrow-circle-right site_points"></i>
                     {{__('your application will be processed')}}
                    </p>

                    <p class="text-left ml-3" style="font-size: 16px; font-weight: 500;"> <i class="fas fa-arrow-circle-right site_points"></i>
                     {{__('you will have to confirm the approved amount')}}
                    </p>
                <a class="card-link" href="{{route('user-applications.index', ['user_id'=> $user->getUserId()])}}">
                <button type="button" class="btn btn-success mt-3 mb-2 buttons_style">
                    <i class="far fa-eye"></i> {{__('view loan status')}}
                </button>
                </a>


            </div>
        </div>

    </div>


@endsection
