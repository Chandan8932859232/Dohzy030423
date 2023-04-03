@extends ('layouts.user')

@section('title', 'Apply For Funds')

@section('content')



    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h3 class="text-center mt-3">Verify Interac eTransfer Deposit Phone</h3> <hr>
            <div>

                <form method="post" action="{{route('verify-deposit-phone-email')}}">
                    @csrf

                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label for="first_name">Email</label>
                            <input type="text" class="form-control" name="applicantFirstname"/>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="first_name">Phone</label>
                            <input type="text" class="form-control" name="applicantFirstname"/>
                        </div>


                    </div>

                    <a href="{{ route('applications.create')}}" class="btn  btn-info pull-left mt-2"> <i class="fas fa-arrow-left"></i> Previous Step </a>
                    <button type="submit" class="btn btn-info mt-2">Next Step <i class="fas fa-arrow-right"></i></button>

                </form>
            </div>
        </div>
    </div>


@endsection
