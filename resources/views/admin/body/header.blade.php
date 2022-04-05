<nav class="navbar fixed-top">
    <div class="d-flex align-items-center navbar-left">
        <a href="#" class="menu-button d-none d-md-block">
            <svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
                <rect x="0.48" y="0.5" width="7" height="1" />
                <rect x="0.48" y="7.5" width="7" height="1" />
                <rect x="0.48" y="15.5" width="7" height="1" />
            </svg>
            <svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
                <rect x="1.56" y="0.5" width="16" height="1" />
                <rect x="1.56" y="7.5" width="16" height="1" />
                <rect x="1.56" y="15.5" width="16" height="1" />
            </svg>
        </a>

        <a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
                <rect x="0.5" y="0.5" width="25" height="1" />
                <rect x="0.5" y="7.5" width="25" height="1" />
                <rect x="0.5" y="15.5" width="25" height="1" />
            </svg>
        </a>


        <!--racourci-->
        <div class="position-relative d-none d-sm-inline-block">
            <button class="header-icon btn btn-empty" type="button" id="iconMenuButton" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                <i class="simple-icon-options"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-left mt-3  position-absolute" id="iconMenuDropdown">
                <a href="#" class="icon-menu-item">
                    <i class="iconsminds-equalizer d-block"></i>
                    <span>Settings</span>
                </a>

                <a href="#" class="icon-menu-item">
                    <i class="iconsminds-male-female d-block"></i>
                    <span>Users</span>
                </a>

                <a href="#" class="icon-menu-item">
                    <i class="iconsminds-puzzle d-block"></i>
                    <span>Components</span>
                </a>

                <a href="#" class="icon-menu-item">
                    <i class="iconsminds-bar-chart-4 d-block"></i>
                    <span>Profits</span>
                </a>

                <a href="#" class="icon-menu-item">
                    <i class="iconsminds-file d-block"></i>
                    <span>Surveys</span>
                </a>

                <a href="#" class="icon-menu-item">
                    <i class="iconsminds-suitcase d-block"></i>
                    <span>Tasks</span>
                </a>

            </div>
        </div>
        {{--<div class="search" data-search-path="Pages.Search.html?q=">
            <input placeholder="Search...">
            <span class="search-icon">
                    <i class="simple-icon-magnifier"></i>
                </span>
        </div>--}}


    </div>


    <a class="navbar-logo" href="{{ route('dashboard') }}">
        <img src="{{asset('/img/logo-andalus-logo.png')}}">
    </a>


    <div class="navbar-right">
        <div class="header-icons d-inline-block align-middle">
            <div class="d-none d-md-inline-block align-text-bottom mr-3">
                <div class="custom-switch custom-switch-primary-inverse custom-switch-small pl-1"
                     data-toggle="tooltip" data-placement="left" title="Dark Mode">
                    <input class="custom-switch-input" id="switchDark" type="checkbox" checked>
                    <label class="custom-switch-btn" for="switchDark"></label>
                </div>
            </div>


            <!--language-->
            <div class="position-relative d-none d-sm-inline-block">

                <div class="nav-item dropdown">
                    <a class="nav-link text-muted waves-effect waves-dark" href=""
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-language" ></i>
                    </a>
                    <div class="dropdown-menu  dropdown-menu-right">

                        <a class="dropdown-item" href="{{ url('locale/en') }}">English</a>

                        <a class="dropdown-item" href="{{ url('locale/ar') }}">العربية</a>

                        <a class="dropdown-item" href="{{ url('locale/fr') }}">French</a>
                    </div>
                </div>
            </div>

            <!--notifications-->
            <div class="position-relative d-inline-block">
                <button class="header-icon btn btn-empty" type="button" id="notificationButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="simple-icon-bell"></i>
                    <span class="count">3</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right mt-3 position-absolute" id="notificationDropdown">
                    <div class="scroll">
                        <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                            <a href="#">
                                <img src="{{ asset('img/profiles/l-2.jpg') }}" alt="Notification Image"
                                     class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />
                            </a>
                            <div class="pl-3">
                                <a href="#">
                                    <p class="font-weight-medium mb-1">Joisse Kaycee just sent a new comment!</p>
                                    <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                </a>
                            </div>
                        </div>
                        <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                            <a href="#">
                                <img src="{{ asset('img/notifications/1.jpg') }}" alt="Notification Image"
                                     class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />
                            </a>
                            <div class="pl-3">
                                <a href="#">
                                    <p class="font-weight-medium mb-1">1 item is out of stock!</p>
                                    <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                </a>
                            </div>
                        </div>
                        <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                            <a href="#">
                                <img src="{{ asset('img/notifications/2.jpg') }}" alt="Notification Image"
                                     class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />
                            </a>
                            <div class="pl-3">
                                <a href="#">
                                    <p class="font-weight-medium mb-1">New order received! It is total $147,20.</p>
                                    <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                </a>
                            </div>
                        </div>
                        <div class="d-flex flex-row mb-3 pb-3 ">
                            <a href="#">
                                <img src="{{asset('img/notifications/3.jpg')}}" alt="Notification Image"
                                     class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />
                            </a>
                            <div class="pl-3">
                                <a href="#">
                                    <p class="font-weight-medium mb-1">3 items just added to wish list by a user!
                                    </p>
                                    <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--fullScreen-->
            <button class="header-icon btn btn-empty d-none d-sm-inline-block" type="button" id="fullScreenButton">
                <i class="simple-icon-size-fullscreen"></i>
                <i class="simple-icon-size-actual"></i>
            </button>

        </div>
        <!--Compte-->
        <div class="user d-inline-block">
            <button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                <span class="name">{{Auth::user()->name }}</span>
                <span>
                        <img alt="Profile Picture" src="{{ (!empty(Auth::user()->profile_photo_path))? Auth::user()->profile_photo_path:asset('img/profiles/no image.png') }} " />
                    </span>
            </button>

            <div class="dropdown-menu dropdown-menu-right mt-3">
                <a class="dropdown-item" href="{{ route('profile.view') }}">{{__('My Profile')}}</a>
                <a class="dropdown-item" href="{{ route('password.view') }}">{{__('Change Password')}}</a>
                <a class="dropdown-item" href="#">History</a>
                <a class="dropdown-item" href="#">Support</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                    {{ __('auth.Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</nav>
