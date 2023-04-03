@extends('layouts.user')

@section('title', 'Loan Waiting List')

@section('content')


    <div class="row">

        <div class="col-sm-8 offset-sm-1">

            <br><br>

                <div class="card notes_style">

                    <div class="card-header">
                        <p class="text-center" style="font-size: 20px; font-weight: 500; color:#251F4F;"> <i class="fas fa-exclamation-triangle" style="color:orange;"></i> {{__('you can not apply for a loan because you are on the waiting list')}}</p>
                    </div>

                    <div class="card-body">

                        <ul>
                            <li class="mt-3 mb-3">{{__('we are going to contact you to let you know when you are no longer on the waiting list')}}</li>
                        </ul>

                        <strong>{{__('for how long do i have to stay on the waiting list')}} ? </strong>
                       <ul>
                           <li class="mt-2 mb-3">{{__('the maximum wait period on the waiting list is 1 week')}}</li>
                       </ul>

                        <a href="{{route('static-pages.index')}}" class="text-center">
                        <button  class="btn btn-outline-dark mt-2">
                            <i class="fas fa-arrow-left"></i> {{__('back to home')}}</button>
                        </a>

                    </div>

                </div>

            </div>

        </div>


    </div>




@endsection
