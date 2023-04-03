@extends ('layouts.guest')

@section('title', 'Session Expired')

@section('content')

    <div class="row">
        <div class="col-sm-8 offset-sm-2">

            <div class="jumbotron mt-4">
                <h2 class="text-center form_title"><i class="fas fa-search-minus"></i> {{__('session expired')}} </h2>
                <hr>

                <ul class="mt-3">
                    <li> <a href="{{route('static-pages.index')}}"><h4><u>{{__('back to home page')}}</u></h4></a></li>
                </ul>

                <ul class="mt-3">
                    <li> <a href="{{route('user.login')}}"><h4><u>{{__('log in')}}</u></h4></a></li>
                </ul>


            </div>
        </div>

    </div>



@endsection


