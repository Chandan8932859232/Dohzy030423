@extends('layouts.guest')


@section('title', 'Contact Us')

@section('content')


<style>
.contact_us_header{
    background:linear-gradient(to right, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1)),url('{{asset('/images/contact-us-pic.jpg')}}');
    background-repeat: no-repeat;
    background-size:100% 100%;
    height:350px;
}

</style>

<div class="jumbotron jumbotron-fluid contact_us_header" >
    <p class="text-center text-white mt-5 static_page_topic" > {{__('contact us')}} </p>
</div>


    <div class="container">

       @if ($message = Session::get('success'))
           <div class="alert alert-success alert-block">
               <button type="button" class="close" data-dismiss="alert">×</button>
               <strong>{{ $message }}</strong>
           </div>
       @endif

           @if ($message = Session::get('error'))
               <div class="alert alert-danger alert-block">
                   <button type="button" class="close" data-dismiss="alert">×</button>
                   <strong>{{ $message }}</strong>
               </div>
           @endif


           @if ($message = Session::get('warning'))
               <div class="alert alert-warning alert-block">
                   <button type="button" class="close" data-dismiss="alert">×</button>
                   <strong>{{ $message }}</strong>
               </div>
           @endif


           @if ($message = Session::get('info'))
               <div class="alert alert-info alert-block">
                   <button type="button" class="close" data-dismiss="alert">×</button>
                   <strong>{{ $message }}</strong>
               </div>
           @endif

<div class="row">
     <div class="col-sm-6 offset-sm-1">

         <!--<p class="mt-2 mb-2" style="color:#312A5C; font-weight:600; font-size: 28px; text-align:center; padding-bottom: 30px; padding-top: 30px;">{{__('let us know of anything')}} </p> -->
         <br><br>
         @include('notes.contact-us-notes')
         <br>

          <form action="#" method="POST">
           @csrf
            <label for="name">{{__('name')}}</label>
            <input type="text" name="name"  class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}">
              @if ($errors->has('name'))
                  <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                           </span>
              @endif

            <label for="email" class="mt-3">{{__('email')}}</label>
            <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}">
              @if ($errors->has('email'))
                  <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                           </span>
              @endif


              <label class="mt-3">{{__('phone')}} <small> ({{__('we need this to contact you with a response')}})</small></label>
              <input type="text" name="phoneNumber" class="form-control {{ $errors->has('phoneNumber') ? ' is-invalid' : '' }}">

                @if ($errors->has('phoneNumber'))
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $errors->first('phoneNumber') }}</strong>
                    </span>
                @endif


            <label for="message" class="mt-3"> {{__('message')}} </label>
            <textarea name="message" cols="30" rows="7" class="form-control {{ $errors->has('message') ? ' is-invalid' : '' }}">
            </textarea>
              @if ($errors->has('message'))
                  <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('message') }}</strong>
                           </span>
              @endif

            <button type="submit" class="btn btn-success btn-block my-4 buttons_style">{{__('send message')}}</button>
          </form>

          <br><br>


       </div>


       @include('notes.follow-us-notes')




   </div>


</div>


@endsection
