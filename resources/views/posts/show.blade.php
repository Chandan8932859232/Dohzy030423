
@extends ('layouts.user')

@section('title', 'Homepage')


@section('content')
   <h2>{{$post->title}}</h2> 
    <div>
      {{$post->description}}
    </div>
      <hr>
      <small> Posted on: {{$post->created_at}}</small>
      <br><a href="/posts" class="btn btn-default"> Go back </a>
      <hr>
      <a href="/posts/{{$post->id}}/edit" class="btn btn-default"> Edit</a>
       <!-- hidden form used to delete item -->
        {!!Form::open(['action' =>['PostsController@destroy',$post->id], 'method'=>'POST', 'class'=>'pull-right'])!!} 
          {{Form::hidden('_method','DELETE')}}
          {{Form::submit('Delete',['class' =>'btn btn-danger'])}}
        {!!Form::close()!!}  
        <!-- ----------- -->
@endsection

<!--page specific scripts -->
@section('scripts')
  <script>
   console.log('Hello world. this is a page specific scrript');
  </script>
@endsection