@extends ('layouts.admin')

@section('title', 'groups')

@section('content')

    <div class="row">
        <div class="col-sm-12">
          <h3 class="display-5">Groups</h3>
          <div class="table-responsive"> 
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Admin</td>
                    <td>Base</td>
                    <td>Members</td>
                    <td>Date</td>
                    <td colspan = 3>Actions</td>
                </tr>
                </thead>
                <tbody>
             @if(count($groups) > 0 )   <!-- check if groups exist then loop through -->
                @foreach($groups as $group)
                    <tr>
                        <td>{{$group->id}}</td>
                        <td>{{$group->group_name}}</td>
                        <td>{{$group->group_admin}}</td>
                        <td>{{$group->group_base}}</td>
                        <td>{{$group->created_at}}</td>
                        <td>
                            <a href="{{ route('groups.edit',$group->id)}}" > <i class="fas fa-edit"></i>  </a>
                        </td>

                        <td>
                            <a href="{{ route('groups.show',$group->id)}}" > <i class="fas fa-eye"></i></a>
                        </td>

                        <td>
                            <form action="{{ route('groups.destroy', $group->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit"> <i class="far fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
             <div class="float-right">
                {{$groups->links()}} <!-- print pagination links -->
             </div>
            </div>
            <div>
            </div>
        @else
        <h2>No groups exist as of now </h2>

     @endif
@endsection
