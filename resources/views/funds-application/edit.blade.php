@extends ('layouts.admin')

@section('title', 'Edit Loan')

@section('content')

    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h3 class="display-4">Edit Application</h3> <hr><br>
            <div>

                <form method="post" action="{{ route('applications.update', $application->id) }}">
                    @method('PATCH')
                    @csrf
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" name="applicantFirstname" value={{ $application->applicant_first_name }}>
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name </label>
                        <input type="text" class="form-control" name="applicantLastname" value={{ $application->applicant_last_name }}>
                    </div>

                    <div class="form-group">
                        <label for="email">Email </label>
                        <input type="text" class="form-control" name="applicantEmail"  value={{ $application->applicant_email }}>
                    </div>
                    <div class="form-group">
                        <label for="city">Phone Number</label>
                        <input type="text" class="form-control" name="applicantPhone"  value={{ $application->applicant_phone_number }}>
                    </div>
                    <div class="form-group">
                        <label for="country">Amount Requested</label>
                        <input type="text" class="form-control" name="applicationAmount"  value={{ $application->application_amount }}>
                    </div>
                    <div class="form-group">
                        <label for="job_title">Group</label>
                        <input type="text" class="form-control" name="applicantGroupName"  value={{ $application->applicant_group }}>
                    </div>
                    <div class="form-group">
                        <label for="job_title">Group's Admin Name</label>
                        <input type="text" class="form-control" name="applicantGroupAdminName" >
                    </div>
                    <button type="submit" class="btn btn-info">Edit Application</button>
                </form>
            </div>
        </div>
    </div>


@endsection
