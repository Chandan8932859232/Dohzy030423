
@inject('user', 'App\Models\User')

<div class="container-fluid user_left_sidebar">
   <ul class="nav flex-column">



      <li class="nav-item">
           <a class="nav-link" href="{{ route('user-dashboard') }}"> <i class="fas fa-home icon_color"></i> {{__('dashboard')}}</a>
       </li> <div class="dropdown-divider"></div>

     @if (!$user->isUserProfileComplete())
       <li class="nav-item">
           <a class="nav-link" href="{{ route('register.complete.intro')}}">
               <i class="spinner-grow spinner-grow-sm icon_color"></i> {{__('complete registration')}}</a>
       </li> <div class="dropdown-divider"></div>
     @endif

       <li class="nav-item">

           <a class="nav-link" href="{{ route('funds-apply.create') }}">

              <i class="fas fa-dollar-sign icon_color"></i> {{__('apply for loan')}}
           </a>

       </li> <div class="dropdown-divider"></div>


       @if ($user->isUserProfileComplete())

           <li class="nav-item">
              <a class="nav-link" href="{{ route('user-applications.index', ['user_id'=> $user->getUserId()]) }}"> <i class="fas fa-hand-holding-usd icon_color"></i> {{__('loans')}}</a>
           </li> <div class="dropdown-divider"></div>

           <li class="nav-item">
               <a class="nav-link" href="{{ route('unpaid.loans', ['user_id'=> $user->getUserId()]) }}"> <i class="fas fa-undo icon_color"></i> {{__('repay loan')}}</a>
           </li> <div class="dropdown-divider"></div>

           <li class="nav-item">
            <a class="nav-link" href="{{ route('wallet.index', ['user_id'=> $user->getUserId()]) }}"> <i class="fas fa-wallet icon_color"></i> {{__('wallet')}}</a>
          </li><div class="dropdown-divider"></div>

            <li class="nav-item">
               <a class="nav-link" href="{{ route('real-estate-ownership.status') }}"> <i class="fas fa-warehouse icon_color"></i> {{__('real estate assistance')}} </a>
           </li> <div class="dropdown-divider"></div>


           <li class="nav-item">
             <a class="nav-link" href="{{ route('profile.show', ['user_id'=> $user->getUserId()]) }}"> <i class="fas fa-user-edit icon_color"></i> {{__('profile')}}</a>
           </li><div class="dropdown-divider"></div>

           @if ($user->userIsTontineMember())
           <li class="nav-item">
            <a class="nav-link" href="{{ route('tontine.index', ['user_id'=> $user->getUserId()]) }}"> <i class="fa fa-users icon_color"></i> {{__('tontine')}}</a>
          </li><div class="dropdown-divider"></div>
           @endif


           <li class="nav-item">
               <a class="nav-link" href="{{ route('user.show-generate-referral-code') }}"> <i class="fas fa-qrcode icon_color"></i></i> {{__('request a referral code')}}</a>
           </li><div class="dropdown-divider"></div>


           <!--
          <li class="nav-item">
             <a class="nav-link" href="{{ route('usage.stats', ['user_id'=> $user->getUserId()]) }}"> <i class="far fa-chart-bar icon_color"></i> {{__('usage statistics')}}</a>
          </li><div class="dropdown-divider"></div> -->

       @endif

       <li class="nav-item">
        <a class="nav-link" href="{{ route('upload.center') }}"> <i class="fas fa-upload icon_color"></i>  {{__('upload center')}}</a>
       </li><div class="dropdown-divider"></div>


       <li class="nav-item">
        <a class="nav-link" href="{{ route('user.referral') }}"> <i class="fas fa-user-friends icon_color"></i> {{__('refer a friend')}}</a>
       </li><div class="dropdown-divider"></div>

       <li class="nav-item">
        <a class="nav-link" href="{{ route('help-center')}}">
            <i class="far fa-question-circle icon_color"></i> {{__('help center')}}</a>
       </li>  <div class="dropdown-divider"></div>

        <!--
       <li class="nav-item">
           <a class="nav-link" href=""> <i class="fas fa-phone-square"></i> {{__('change phone number')}}</a>
       </li> <div class="dropdown-divider"></div>

       <li class="nav-item">
           <a class="nav-link" href=""> <i class="far fa-envelope"></i> {{__('change login email')}}</a>
       </li> <div class="dropdown-divider"></div>
        -->



   </ul>
</div>

