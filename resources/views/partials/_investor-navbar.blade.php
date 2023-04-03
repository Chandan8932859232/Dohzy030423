<header>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#ffffff;">
        <a class="navbar-brand logo_adjust"  href="{{ route('static-pages.index') }}">
            <img src="{{ asset('images/dohzy logo - dark purple.svg') }}"   alt="Dohzy Logo">
        </a>

        <ul class="nav lang_tap_for_mobile">
                 <!-- get and store locale. $locale will be used to translate site based on localisation -->
                    @php $locale = session()->get('locale'); @endphp
                    <li class="nav-item dropdown" style="text-decoration: none;">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @switch($locale)
                                @case('fr')
                                <img src="{{asset('images/fr-flag.png')}}" width="20px" height="20px"> FR
                                @break
                                @default
                                <img src="{{asset('images/us-flag.png')}}" width="20px" height="20px"> EN
                            @endswitch

                            <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item"  href="lang/en"><img src="{{asset('images/us-flag.png')}}" width="20px" height="20px" > EN</a>
                            <a class="dropdown-item"  href="lang/fr"><img src="{{asset('images/fr-flag.png')}}" width="20px" height="20px" > FR</a>
                        </div>
                    </li>
        </ul>



        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto static_navigation">
                <li class="nav-item active">
                    @if(Auth::check())
                     <!--   <a class="nav-link" href="{{route('user-dashboard')}}">Home <span class="sr-only">(current)</span></a> -->

                    @endif

                </li>

                @if(!Auth::check()) <!-- if not logged in-->


                    <li class="nav-item">
                    <a class="nav-link ml-2 mr-2" href="{{route('static-pages.index')}}">{{__('home')}} <span class="sr-only">(current)</span></a>
                    </li>

                <li class="nav-item">
                    <a class="nav-link ml-2 mr-2" href="{{route('static-pages.about')}}">{{__('about')}}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link ml-2 mr-2" href="{{route('contact.us')}}">{{__('contact')}}</a>
                </li>
                <li class="nav-item">

                    <a class="nav-link ml-2 mr-2" href="{{route('static-pages.common-questions')}}">{{__('questions')}}</a>
                </li>

                @endif


            </ul>


             {{-- Dropdown For Mobile --}}
             <ul class="navbar-nav mr-auto user_navigation">

             @if(Auth::check()) {{--if user is logged in --}}

                @inject('user', 'App\Models\User')

                 <a class="nav-link" href="{{ route('user-dashboard') }}">
                     <i class="fas fa-user icon_color"></i> {{__('hi')}}, {{ Auth::user()->firstname }}
                 </a> <div class="dropdown-divider"></div>

                <a class="nav-link" href="{{ route('user-dashboard') }}">
                    <i class="fas fa-home icon_color"></i> {{__('dashboard')}}
                </a> <div class="dropdown-divider"></div>

                @if (!$user->isUserProfileComplete())
                <a class="nav-link" href="{{ route('register.complete.intro')}}">
                    <i class="spinner-grow spinner-grow-sm icon_color"></i> {{__('complete registration')}}
                </a> <div class="dropdown-divider"></div>
               @endif

                <a class="nav-link" href="{{ route('funds-apply.create') }}">
                    <i class="fas fa-dollar-sign icon_color"></i>
                      @if($user->getUserType()==1)
                       {{__('apply for loan')}}
                      @endif
                      @if($user->getUserType()==4)
                      {{__('apply for a business loan')}}
                     @endif

                </a> <div class="dropdown-divider"></div>

                @if ($user->isUserProfileComplete())
                <a class="nav-link" href="{{ route('user-applications.index', ['user_id'=> $user->getUserId()]) }}">
                    <i class="fas fa-hand-holding-usd icon_color"></i> {{__('loans')}}
                </a> <div class="dropdown-divider"></div>

                     <a class="nav-link" href="{{ route('unpaid.loans', ['user_id'=> $user->getUserId()]) }}">
                         <i class="fas fa-undo icon_color"></i> {{__('repay loan')}}
                     </a> <div class="dropdown-divider"></div>


                <a class="nav-link" href="{{ route('wallet.index', ['user_id'=> $user->getUserId()]) }}">
                    <i class="fas fa-wallet icon_color"></i> {{__('wallet')}}
                </a>
                <div class="dropdown-divider"></div>


                 <a class="nav-link" href="{{ route('real-estate-ownership.status') }}">
                     <i class="fas fa-warehouse icon_color"></i> {{__('real estate assistance')}}
                 </a> <div class="dropdown-divider"></div>


                 <a class="nav-link" href="{{ route('profile.show', ['user_id'=> $user->getUserId()]) }}">
                    <i class="fas fa-user-edit icon_color"></i> {{__('profile')}}
                  </a> <div class="dropdown-divider"></div>

                  @if ($user->userIsTontineMember())
                  <a class="nav-link" href="{{ route('tontine.index', ['user_id'=> $user->getUserId()]) }}">
                    <i class="fa fa-users icon_color"></i> {{__('tontine')}}
                  </a> <div class="dropdown-divider"></div>
                  @endif


                     <li class="nav-item">
                         <a class="nav-link" href="{{ route('user.show-generate-referral-code') }}"> <i class="fas fa-qrcode icon_color"></i> {{__('request a referral code')}}</a>
                     </li><div class="dropdown-divider"></div>


                     <!--
                    <a class="nav-link" href="{{ route('usage.stats', ['user_id'=> $user->getUserId()]) }}">
                        <i class="far fa-chart-bar icon_color"></i> {{__('usage statistics')}}
                    </a> <div class="dropdown-divider"></div> -->
                @endif

                <a class="nav-link" href="{{ route('upload.center') }}">
                    <i class="fas fa-upload icon_color"></i> {{__('upload center')}}
                </a> <div class="dropdown-divider"></div>


                <a class="nav-link" href="{{ route('help-center') }}">
                    <i class="far fa-question-circle icon_color"></i> {{__('help center')}}
                </a> <div class="dropdown-divider"></div>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.referral') }}"> <i class="fas fa-user-friends icon_color"></i> {{__('refer a friend')}}</a>
                </li><div class="dropdown-divider"></div>


                <a class="nav-link" href="{{ route('show-password.form')}}">
                    <i class="fas fa-lock icon_color"></i> {{__('change password')}}
                </a> <div class="dropdown-divider"></div>

                 <a class="nav-link" href="{{route('logout')}}">
                     <i class="fas fa-sign-out-alt icon_color"></i> {{__('log out')}}
                     <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                         @csrf
                     </form>
                 </a>

              @endif

                 @if(!Auth::check()) {{--if user is not logged in --}}

                 <li class="nav-item">
                     <a class="nav-link" href="{{route('static-pages.index')}}">{{__('home')}}</a>
                 </li><div class="dropdown-divider"></div>

                 <li class="nav-item">
                     <a class="nav-link" href="{{route('static-pages.about')}}">{{__('about us')}}</a>
                 </li><div class="dropdown-divider"></div>

                 <li class="nav-item">
                     <a class="nav-link" href="{{route('contact.us')}}">{{__('contact us')}}</a>
                 </li><div class="dropdown-divider"></div>

                 <li class="nav-item">
                     <a class="nav-link" href="{{route('static-pages.common-questions')}}">{{__('common questions')}}</a>
                 </li><div class="dropdown-divider"></div>

                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('user.login') }}">{{ __('Login') }} </a>
                 </li><div class="dropdown-divider"></div>

                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('user.register')  }}">{{ __('Register') }}</a>
                 </li><div class="dropdown-divider"></div>




                 @endif


             </ul>



            <!-- Right Side Of Navbar (will not be dislayed on mobile)-->
            <ul class="nav navbar-nav ml-auto right_side_navbar" style="font-size: 16px; font-weight: 500; padding-right: 15px;">
                <form class="form-inline mt-2 mt-md-0">
            <!-- get and store locale. $locale will be used to translate site based on localisation -->
            @php $locale = session()->get('locale'); @endphp
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    @switch($locale)
                        @case('fr')
                        <img src="{{asset('images/fr-flag.png')}}" width="20px" height="20px"> Français
                        @break
                        @default
                        <img src="{{asset('images/us-flag.png')}}" width="20px" height="20px"> English
                    @endswitch

                    <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  href="lang/en"><img src="{{asset('images/us-flag.png')}}" width="20px" height="20px" > English</a>
                    <a class="dropdown-item"  href="lang/fr"><img src="{{asset('images/fr-flag.png')}}" width="20px" height="20px" > Français</a>
                </div>
            </li>

                <!-- Authentication Links -->
                    @guest

                        <li class="nav-item pr-3">
                            <button class="login_button" type="submit" >
                              <a class="nav-link" style="color:#000000;" href="{{ route('investor.login') }}">{{ __('investor log in') }} </a>
                            </button>
                        </li>
                        @if (Route::has('investor.register'))
                            <li class="nav-item">
                                <button class="register_button" type="submit" >
                                    <a class="nav-link" style="color:#000000;" href="{{ route('investor.register')  }}"> {{ __('investor register') }}</a>
                                </button>
                            </li>
                </form>
                @endif
                @else


                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fas fa-user icon_color"></i> {{ Auth::user()->firstname }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                            <a class="nav-link" href="{{ route('user-dashboard') }}">
                                <i class="fas fa-home icon_color"></i> {{__('dashboard')}}
                            </a>
                            <div class="dropdown-divider"></div>

                            <a class="nav-link" href="{{ route('profile.show', ['user_id'=> $user->getUserId()]) }}">
                                <i class="fas fa-user-edit icon_color"></i> {{__('profile')}}
                            </a>
                            <div class="dropdown-divider"></div>


                            <a class="nav-link" href="{{ route('show-password.form')}}"> <i class="fas fa-lock icon_color"></i> {{__('change password')}}
                            </a>
                            <div class="dropdown-divider"></div>


                        <a class="nav-link" href="{{ route('logout')}}"><i class="fas fa-sign-out-alt icon_color"></i> {{__('log out')}}

                            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </a>
                        {{--
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form> --}}

                    </div>
                </li>
            @endguest


        </ul>

    </div>
</nav>

</header>


