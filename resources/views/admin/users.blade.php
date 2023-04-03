@extends ('layouts.admin')

@section('title', 'Loans')

@section('content')

    @inject('loan', 'App\Services\LoanService')

    @inject('timeZoneConversion', 'App\Services\DateTimeService')

    <div class="row">
        <div class="col-sm-12">
          <h3 class="display-5 mt-4 mb-4">Users </h3>
          <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                <tr style="font-weight: bold; background-color:#8a84a6; color:white;">
                    <td>User ID</td>
                    <td>Account ID</td>
                    <td>User names </td>
                    <td>Email</td>
                    <td>Sign up date</td>
                    <td>Status</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
             @if(count($users) > 0 )   <!-- check if applications exist then loop through -->
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->account_id}}</td>
                        <td>{{$user->firstname}} {{$user->lastname}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$timeZoneConversion->convertTimeToEST($user->created_at)}}</td>
                        <td>NA</td>
                
                     <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-outline-dark">Actions</button>
                            <button type="button" class="btn btn-outline-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
                                <span class="caret"></span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href=""><i class="fas fa-eye"></i> View User Details</a>
                                <a class="dropdown-item" href="{{route('admin.show-change-loan-limit', $user->id)}}"><i class="fas fa-exchange-alt"></i> Change Loan Limit </a>
                                <a class="dropdown-item" href="{{route('admin.show-change-user-type', $user->id)}}"><i class="fas fa-users-cog"></i> Change Account Type </a>
                                <a class="dropdown-item" href=""><i class="fas fa-comments-dollar"></i> Deactivate User account </a>
                                {{--
                                <a class="dropdown-item" href="{{ route('applications.edit',$application->id)}}"><i class="fas fa-edit"></i> Edit Loans </a>
                                <a class="dropdown-item" href="#"><i class="fas fa-ban"></i> Reject loan</a>
                                 --}}
                                <a class="dropdown-item" type="submit" onclick="return confirm('Are you sure ? this will delete the record permanently')"
                                   href="">
                                    {{--
                                    <form action="{{ route('applications.destroy', $application->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')">  </button>
                                    </form>


                                    <i class="far fa-trash-alt"></i> Cancel loan
                                     --}}

                                </a>

                            </div>
                        </div>
                     </td>

                     {{--
                        <td>
                            <a href="{{ route('applications.edit',$application->id)}}" > <i class="fas fa-edit"></i>  </a>
                        </td>

                        <td>
                            <a href="{{ route('applications.show',$application->id)}}" > <i class="fas fa-eye"></i></a>
                        </td>

                        <td>
                            <form action="{{ route('applications.destroy', $application->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')"> <i class="far fa-trash-alt"></i></button>
                            </form>
                        </td> --}}
                    </tr>
                @endforeach
                </tbody>
            </table>
             <div class="float-right">
                {{$users->links()}} <!-- print pagination links -->
             </div>
            </div>
            <div>
            </div>

        @else
        <h2>No users exist as of now </h2>

     @endif

            <script>
                setTimeout('window.location.reload();', 40000);
            </script>
@endsection
