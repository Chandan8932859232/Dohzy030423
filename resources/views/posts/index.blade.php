
@extends ('layouts.user')

@section('title', 'Homepage')



@section('content')
 
   <h2>Posts (Items for sale)</h2> <br>
    <!-- display all posts -->
     @if(count($posts) > 0 )   <!-- check if posts exist then loop through the items and display them -->
         @foreach($posts as $post )
           <div class="card">
              <h3><a href="/posts/{{$post->id}}"> {{$post->title}} </a></h3> 
              <small> Posted on: {{$post->created_at}}</small>
           </div> <br>
         @endforeach
          {{$posts->links()}} <!-- print pagination links -->
     @else
        <p>No items have been posted</p>

     @endif

@endsection

<!--page specific scripts -->
@section('scripts')
  <script>
   console.log('Hello world. this is a page specific scrript');
  </script>
@endsection