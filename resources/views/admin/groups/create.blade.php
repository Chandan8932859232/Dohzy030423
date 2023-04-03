@extends ('layouts.admin')

@section('title', 'Create Group')

@section('content')

    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h2 class="display-5">Create Group</h2>
            <div>

                <form method="post" action="{{ route('groups.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="group_name">Group name</label>
                        <input type="text" class="form-control" name="groupName"/>
                    </div>

                    <div class="form-group">
                        <label for="group_admin">Group admin </label>
                        <input type="text" class="form-control" name="groupAdmin"/>
                    </div>

                    <div class="form-group">
                        <label for="email">Email </label>
                        <input type="text" class="form-control" name="groupAdminEmail"/>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" class="form-control" name="groupAdminPhoneNumber"/>
                    </div>
                    <div class="form-group">
                        <label for="groupbase">Group base</label>
                        <input type="text" class="form-control" name="groupBase"/>
                    </div>

                    <div class="form-group">
                        <label for="members_total">Number of members</label>
                        <input type="text" class="form-control" name="totalGroupMembers"/>
                    </div>
                  
                    <button type="submit" class="btn btn-info">Create Group</button>
                </form>
            </div>
        </div>
    </div>


@endsection