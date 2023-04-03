@extends ('layouts.admin')

@section('title', 'Admin Home')

@section('content')

@inject('systemMetrics','App\Http\Controllers\Admin\AnalyticsController')


    <div class="container mt-5">

        <div class="card-columns mr-2 loans_metric_loans_page">

            <div class="card bg-light">
                <div class="card-body text-center">
                    <h5 class="card-title" style="color:#000000;"> Number of users <p>(2020 - present)</p></h5>
                    <p class="card-text" style="color:#685EA6; font-size: 24px; font-weight:500;">{{$systemMetrics->getTotalUsers()}}</p>
                </div>
            </div>

            <div class="card bg-light">
                <div class="card-body text-center">
                    <h5 class="card-title" style="color:#000000;"> Number of users <p>(2020)</p></h5>
                    <p class="card-text" style="color:#685EA6; font-size: 24px; font-weight:500;">{{$systemMetrics->getTotalUsersForAYear(2020)}}</p>
                </div>
            </div>

            <div class="card bg-light">
                <div class="card-body text-center">
                    <h5 class="card-title" style="color:#000000;"> Number of users <p>(2021)</p></h5>
                    <p class="card-text" style="color:#685EA6; font-size: 24px; font-weight:500;">{{$systemMetrics->getTotalUsersForAYear(2021)}}</p>
                </div>
            </div>

            <div class="card bg-light">
                <div class="card-body text-center">
                    <h5 class="card-title" style="color:#000000;">  Female Users</h5>
                    <p class="card-text" style="color:#685EA6; font-size: 24px; font-weight:500;">{{$systemMetrics->getTotalFemaleUsers()}}</p>
                </div>
            </div>
           
            <div class="card bg-light">
                <div class="card-body text-center">
                    <h5 class="card-title" style="color:#000000;">  Male Users</h5>
                    <p class="card-text" style="color:#685EA6; font-size: 24px; font-weight:500;">{{$systemMetrics->getTotalMaleUsers()}}</p>
                </div>
            </div>

            
            <div class="card bg-light">
                <div class="card-body text-center">
                    <h5 class="card-title" style="color:#000000;">  Average Age of Users</h5>
                    <p class="card-text" style="color:#685EA6; font-size: 24px; font-weight:500;">{{$systemMetrics->getAverageUsersAge()}}</p>
                </div>
            </div>
            
           
           

            <div class="card bg-light">
                <div class="card-body text-center">
                    <h5 class="card-title" style="color:#000000;">  Number of Loans <p>(2020 - present)</p></h5>
                    <p class="card-text" style="color:#685EA6; font-size: 24px; font-weight:500;">{{$systemMetrics->getTotalNumberOfLoans()}}</p>
                </div>
            </div>

            <div class="card bg-light">
                <div class="card-body text-center">
                    <h5 class="card-title" style="color:#000000;">  Number of Loans <p>(2021)</p></h5>
                    <p class="card-text" style="color:#685EA6; font-size: 24px; font-weight:500;">{{$systemMetrics->getTotalNumberOfLoansForAYear('2021')}}</p>
                </div>
            </div>

            <div class="card bg-light">
                <div class="card-body text-center">
                    <h5 class="card-title" style="color:#000000;">  Number of Loans <p>(2020)</p></h5>
                    <p class="card-text" style="color:#685EA6; font-size: 24px; font-weight:500;">{{$systemMetrics->getTotalNumberOfLoansForAYear('2020')}}</p>
                </div>
            </div>


            <div class="card bg-light">
                <div class="card-body text-center">
                    <h5 class="card-title" style="color:#000000;"> Total Loaned Amount <p>(2020 - present)</p></h5>
                    <p class="card-text" style="color:#685EA6; font-size: 24px; font-weight:500;">${{number_format($systemMetrics->getTotalLoanedAmount())}}</p>
                </div>
            </div>

            <div class="card bg-light">
                <div class="card-body text-center">
                    <h5 class="card-title" style="color:#000000;"> Total Loaned Amount <p>(2020)</p></h5>
                    <p class="card-text" style="color:#685EA6; font-size: 24px; font-weight:500;">${{number_format($systemMetrics-> getTotalLoanedAmountForAYear('2020'))}}</p>
                </div>
            </div>

            <div class="card bg-light">
                <div class="card-body text-center">
                    <h5 class="card-title" style="color:#000000;"> Total Loaned Amount <p>(2021)</p></h5>
                    <p class="card-text" style="color:#685EA6; font-size: 24px; font-weight:500;">${{number_format($systemMetrics-> getTotalLoanedAmountForAYear('2021'))}}</p>
                </div>
            </div>



            <div class="card bg-light">
                <div class="card-body text-center">
                    <h5 class="card-title" style="color:#000000;"> Average Individual loan amount<p>(2020 - present)</p></h5>
                    <p class="card-text" style="color:#685EA6; font-size: 24px; font-weight:500;">${{number_format($systemMetrics->getAverageIndividualLoanedAmount())}}</p>
                </div>
            </div>

            <div class="card bg-light">
                <div class="card-body text-center">
                    <h5 class="card-title" style="color:#000000;"> Average Individual loan amount<p>(2020)</p></h5>
                    <p class="card-text" style="color:#685EA6; font-size: 24px; font-weight:500;">${{number_format($systemMetrics->getAverageIndividualLoanedAmountForAYear('2020'))}}</p>
                </div>
            </div>

            <div class="card bg-light">
                <div class="card-body text-center">
                    <h5 class="card-title" style="color:#000000;"> Average Individual loan amount<p>(2021)</p></h5>
                    <p class="card-text" style="color:#685EA6; font-size: 24px; font-weight:500;">${{number_format($systemMetrics->getAverageIndividualLoanedAmountForAYear('2021'))}}</p>
                </div>
            </div>


            <div class="card bg-light">
                <div class="card-body text-center">
                    <h5 class="card-title" style="color:#000000;"> Total amount owed<p>(2020)</p></h5>
                    <p class="card-text" style="color:#685EA6; font-size: 24px; font-weight:500;">${{number_format($systemMetrics->getTotalLoanedAmountForAYear('2020'))}}</p>
                </div>
            </div>

            <div class="card bg-light">
                <div class="card-body text-center">
                    <h5 class="card-title" style="color:#000000;"> Total amount owed<p>(2021)</p></h5>
                    <p class="card-text" style="color:#685EA6; font-size: 24px; font-weight:500;">${{number_format($systemMetrics->getTotalLoanedAmountForAYear('2021'))}}</p>
                </div>
            </div>






        </div>

 {{--
    <div class="row">
        <div class="col-sm-4">
            <h4><i class="fas fa-file-invoice-dollar"></i> Applications : 0</h4>

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

        <div class="col-sm-4">
            <h4><i class="fas fa-thermometer-three-quarters"></i> Interest rate : 10%</h4>
            <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
        </div>

        <div class="col-sm-4">
            <h4><i class="fas fa-clipboard-check"></i> Approvals: 0</h4>
            <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
        </div>

        <div class="col-sm-4">
            <h4><i class="fas fa-clipboard-check"></i> Approvals: 0</h4>
            <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
        </div>

    </div>
    --}}

</div>

@endsection

<!--page specific scripts -->
@section('scripts')
  <script>
   console.log('Hello world. this is a page specific script');
  </script>
@endsection
