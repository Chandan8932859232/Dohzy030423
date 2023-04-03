
@extends('layouts.user')

@section('title', 'Payment center')

@section('content')





<div class="row">
 <div class="col-sm-8">

    <h3 class="text-center mt-3 form_title">{{__('payment center')}} </h3>


 <div class="container mt-5 mb-4">
    <div class="card text-dark">
        <div class="card-body">

            <p class="ml-3 mt-3">  <a href="https://buy.stripe.com/9AQ6rL2mKcJj5b2cMO" target="_blank" rel="noopener noreferrer"><u style="color:#000000">{{__('pay for a business account')}}</u></a></p>

            <p class="ml-3 mt-4">  <a href="https://buy.stripe.com/3cs7vPgdA24FfPGfZ1" target="_blank" rel="noopener noreferrer"><u style="color:#000000">{{__('pay for the savings program')}}</u></a></p>

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
