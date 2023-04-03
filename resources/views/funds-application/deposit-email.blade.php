@extends ('layouts.user')

@section('title', 'Apply For Funds')

@section('content')


    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h3 class="text-center mt-3">Verify Interac eTransfer Deposit Email</h3> <hr>
            <div>

                <form method="post" action="{{route('verify-deposit.email')}}">
                    @csrf

                  <div class="form-row">

                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="text" class="form-control" value={{$userEmail}} name="userDepositEmail">

                        <small> This is the email we have on ....... </small>
                    </div>

                </div>

                    <a href="{{ route('applications.create')}}" class="btn  btn-info pull-left mt-2"> <i class="fas fa-arrow-left"></i> Previous Step </a>
                    <button type="submit" class="btn btn-info mt-2">Review Application <i class="fas fa-arrow-right"></i></button>

                </form>
            </div>
        </div>
    </div>


@endsection
