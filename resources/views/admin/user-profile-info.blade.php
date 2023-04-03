@extends ('layouts.admin')

@section('title', 'Admin -  User Profile')

@section('content')

@inject('loan', 'App\Services\LoanService')

@inject('timeZoneConversion', 'App\Services\DateTimeService')


    <h2  class="mt-4 mb-5 text-center"> User Information </h2>

    <div class="container mt-4">

        <table class="table">

            <tbody>

         <h4 class="mb-5"> {{$userInfo->firstname}} {{$userInfo->lastname}} </h4>

             <tr>

                <td>{{__('account id')}} : <strong>{{$userInfo->account_id}}</strong></td>

                <td>
                    {{ __('account type')}} :
                    @if($userInfo->user_type ==1)
                         <strong><i class="fas fa-user"></i> {{__('personal')}}</strong>
                    @endif

                    @if($userInfo->user_type ==2)
                        <strong><i class="fa-regular fa-users"></i> {{__('group member')}}</strong>
                    @endif

                    @if($userInfo->user_type ==3)
                        <strong><i class="fa-regular fa-earth-africa"></i> {{__('africa based user')}}</strong>
                    @endif

                    @if($userInfo->user_type ==4)
                        <strong><i class="fa-solid fa-briefcase"></i> {{__('business')}}</strong>
                    @endif
                </td>


                <td>
                    {{__('account status')}} :

                    @if($userInfo->profile_complete_status ==0)
                      <span class="badge badge-success">{{__('incomplete')}}</span>
                    @endif

                    @if($userInfo->profile_complete_status ==1)
                      <span class="badge badge-success">{{__('complete')}}</span>
                    @endif

                </td>


                @php
                $createdDateTime = explode(" ", $userInfo->created_at) ;
                $createdDate = $createdDateTime[0];
                @endphp

                <td>{{__('member since')}}: <strong>{{$createdDate}}</strong>

            </td>
            </tr>

            <tr>
                <td>{{__('dohzy score')}}: <strong>{{$userLoanMetrics->rank}}</strong> </td>
                <td>{{__('gender')}}: <strong>{{$userInfo->gender}}</strong></td>
                <td>{{__('language')}} : <strong>{{$userInfo->language}}</strong> </td>
                <td>Age : <strong>{{$userInfo->birth_date}}</strong> </td>

            </tr>

            <tr>
                <td>{{__('phone')}}: <strong>{{$userPhone->phone_number}}</strong> </td>
                <td>{{__('address')}}: <strong>{{$userAddress->address_info}} , {{$userAddress->city}}, {{$userAddress->province}},  {{$userAddress->postal_code}}  </strong></td>
                <td>Country of origin <strong>{{$userInfo->country_of_origin}}</strong> </td>
                <td>Loan level : <strong>{{$userLoanMetrics->loan_level}}</strong> </td>
            </tr>

            <tr>
                <td>{{__('email')}}: <strong>{{$userInfo->email}}</strong> </td>
                <td>Base Interest Rate : <strong>{{$userLoanMetrics->interest_rate}}</strong></td>

                <td>NA <strong> NA </strong> </td>


                @php
                 $userTags = explode(",", $userInfo->tags);
                @endphp

                <td>

                 @foreach ($userTags as $userTag)
                  <span class="badge badge-dark"> {{$userTag}} </span>
                 @endforeach

                </td>



                <td>NA : <strong> NA </strong> </td>
            </tr>

            </tbody>
        </table>





        <h4 class="display-5 mt-5 mb-3">User Loans </h4>

        @if(count($applications) > 0 )   <!-- check if applications exist then loop through -->
        <div class="table-responsive">
          <table class="table">
              <thead class="thead-dark">
              <tr style="font-weight: bold; background-color:#5d5a67; color:white;">

                  <td>Loan ID</td>
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
                      <td>{{$application->id}}</td>
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
          <div>
          </div>

      @else

      <h4> No loans found for user </h4>

    @endif























    </div>


@endsection
