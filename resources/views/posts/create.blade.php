
@extends ('layouts.user')

@section('title', 'Homepage')



@section('content')
   <h2>Create Post</h2> <br>
    <!-- when form is submitted it will make a post request to store function in the controlller -->
   {!! Form::open(['action'=>'PostsController@store','method'=>'POST']) !!}
     <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title', '',['class' =>'form-control','placeholder'=>'Title'])}}
     </div>

     <div class="form-group">
        {{Form::label('body', 'Description')}}
        {{Form::textarea('description', '',['class' =>'form-control','placeholder'=>'Body Text'])}}
     </div>
     {{Form::submit('Submit',['class'=>'btn btn-primary'])}}

    {!! Form::close() !!}


@endsection

<!--page specific scripts -->
@section('scripts')
  <script>
   console.log('Hello world. this is a page specific scrript');
  </script>
@endsection