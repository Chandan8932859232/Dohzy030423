
@extends('layouts.user')

@section('title', 'Request center')

@section('content')





<div class="row">
 <div class="col-sm-8">

    <h3 class="text-center mt-3 form_title">{{__('request center')}} </h3>


 <div class="container mt-5 mb-4">
    <div class="card text-dark">
        <div class="card-body">

            <p class="ml-3 mt-2"> <i class="fas fa-arrow-circle-right site_points"></i> <a href="{{route('request.business-account')}}"><u style="color:#000000">{{__('request for a business account')}}</u></a></p>

            <p class="ml-3"> <i class="fas fa-arrow-circle-right site_points"></i> <a href="{{route('tontine-member.request')}}"><u style="color:#000000">{{__('request to participate in tontine')}}</u></a></p>

        </div>
    </div>
 </div>


 </div>
</div>


<br><br><br><br><br><br><br><br>





@endsection




<!--page specific scripts -->
@section('scripts')




 @endsection
