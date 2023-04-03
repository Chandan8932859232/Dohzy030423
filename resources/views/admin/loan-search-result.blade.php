@extends ('layouts.admin')

@section('title', 'Loans')

@section('content')

    @inject('loan', 'App\Services\LoanService')

    @inject('timeZoneConversion', 'App\Services\DateTimeService')

    <div class="row">
        <div class="col-sm-12">
          <h3 class="display-5 mt-4 mb-4">Loans </h3>
          @if(count($applications) > 0 )   <!-- check if applications exist then loop through -->
          <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                <tr style="font-weight: bold; background-color:#7261c0; color:white;">
                    <td>Account ID</td>
                    <td>Loan ID</td>
                    <td>User names </td>
                    <td>Loan Amount</td>
                    <td>Payback Amount</td>
                    <td>Balance</td>
                    <td>Request Date</td>
                    <td>Security</td>
                    <td>Status</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>

                @foreach($applications as $application)
                    <tr>
                        <td>{{$loan->getAccountIdOfLoanApplicant($application->applicant_user_id)}}</td>
                        <td>{{$application->id}}</td>
                        <td>{{$loan->getNameOfLoanApplicant($application->applicant_user_id)}}</td>
                        <td>${{$application->application_amount}}</td>
                        <td>${{$application->payback_amount}}</td>
                        <td>${{$application->balance}}</td>
                        <td>{{$timeZoneConversion->convertTimeToEST($application->created_at)}}</td>

                        <td>

                            @if($application->security_score > 1)
                                <span class="badge badge-danger" style="width:20px; height:20px;" ><strong>{{$application->security_score}}</strong></span>
                            @endif
                            @if($application->security_score == 1)
                            <span class="badge badge-warning" style="width:20px; height:20px;"><strong>{{$application->security_score}}</strong></span>
                                @endif
                        </td>

                        <td class="label label-default">
                            <span class="badge badge-dark">
                                {{$loan->getApplicationStatus($application->application_status)}}
                            </span>
                        </td>


                     <td>
                        @include('sections.loan-actions')
                     </td>


                    </tr>
                @endforeach
                </tbody>
            </table>
             <div class="float-right">
                {{$applications->links()}} <!-- print pagination links -->
             </div>
            </div>
             </div>
            </div>



        @else

        <h2 class="text-danger" > No search results found </h2>

     @endif


@endsection
