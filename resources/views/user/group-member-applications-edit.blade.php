@extends ('layouts.user')

@section('title', 'Edit Loan')

@section('content')


    <div class="row mt-3">

        <div class="col-sm-4">
            <h4><i class="fas fa-question-circle"></i> Status : To be processed</h4>

            <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
        </div>

        <div class="col-sm-4">
            <h4><i class="fas fa-thermometer-three-quarters"></i> Interest rate : 10%</h4>
            <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
        </div>

        <div class="col-sm-4">
            <h4><i class="fas fa-clipboard-check"></i> Approvals: 0</h4>
            <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
        </div>

        <div class="col-sm-8 offset-sm-0">
            <h3>Edit Application</h3> <hr>
            <div>

                <form method="post" action="{{ route('user-applications.update', $userApplication->id) }}">
                   @method('PUT')
                    @csrf
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="job_title">Group</label>
                            <input type="text" class="form-control" name="applicantGroupName"
                                   value={{ $userApplication->applicant_group }}>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="job_title">Group</label>
                            <input type="text" class="form-control" name="applicantGroupName"
                                   value={{ $userApplication->applicant_group }}>
                        </div>

                        <div class="form-group col-md-6">
                        <label for="last_name">Last Name </label>
                        <input type="text" class="form-control" name="applicantLastname"
                               value={{ $userApplication->applicant_last_name }}>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="email">Email </label>
                        <input type="text" class="form-control" name="applicantEmail"
                               value={{ $userApplication->applicant_email }}>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="city">Phone Number</label>
                        <input type="text" class="form-control" name="applicantPhone"
                               value={{ $userApplication->applicant_phone_number }}>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="country">Amount Requested</label>
                        <input type="text" class="form-control" name="applicationAmount"
                               value={{ $userApplication->application_amount }}>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="job_title">Group's Admin Name</label>
                        <input type="text" class="form-control" name="applicantGroupAdminName" >
                    </div>

                    </div>


                    <button type="submit" class="btn btn-info"> <i class="far fa-edit"></i> Edit Application</button>
                    <a href="{{route('user-application.delete',$userApplication->id)}}" class="btn  btn-outline-danger"> <i class="far fa-trash-alt"></i> Cancel Application  </a>

                </form>
            </div>
        </div>


        <div class="col-sm-4">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">First item</li>
                <li class="list-group-item">Second item</li>
                <li class="list-group-item">Third item</li>
                <li class="list-group-item">Fourth item</li>
            </ul>

        </div>

    </div>




@endsection
