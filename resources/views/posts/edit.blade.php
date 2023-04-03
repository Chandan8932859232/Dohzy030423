@extends ('layouts.user')

@section('title', 'Homepage')



@section('content')
   <h2>Edit Post</h2> <br>
    <!-- when form is submitted it will make a post request to store function in the controlller -->
   {!! Form::open(['action'=>['PostsController@update',$post->id],'method'=>'POST']) !!}
     <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title', $post->title,['class' =>'form-control','placeholder'=>'Title'])}}
     </div>

     <div class="form-group">
        {{Form::label('body', 'Description')}}
        {{Form::textarea('description', $post->description,['class' =>'form-control','placeholder'=>'Body Text'])}}
     </div>
     {{Form::hidden('_method','PUT')}} <!-- spoof or fake a PUT request to allow edit since we can not place a POST at the top -->
     {{Form::submit('Submit',['class'=>'btn btn-primary'])}}

    {!! Form::close() !!}


@endsection

<!--page specific scripts -->
@section('scripts')
  <script>
   console.log('Hello world. this is a page specific scrript');
  </script>
@endsection