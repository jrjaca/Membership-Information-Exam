<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{route('index')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/registration.jpg') }}" alt="" height="25">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/registration.jpg') }}" alt="" height="50">
                    </span>
                </a>

                <a href="{{route('index')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/registration.jpg') }}" alt="" height="25">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/registration.jpg') }}" alt="" height="50">
                    </span>
                </a>
            </div>
            <!-- /LOGO -->

            <!-- Show/Hide Menus -->
            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            <!-- /Show/Hide Menus -->
            
            <h1 style="color: #111; font-family: 'Open Sans', sans-serif; font-size: 20px; font-weight: 300; line-height: 32px; margin: 0 100 72px; text-align: center;">
                {{env('APP_NAME')}} (MIS)</h1>
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

            <span class="d-none d-xl-inline-block ml-1">Welcome {{ Session::get('user_info_sess')['FirstName'] }}
                                                                {{ Session::get('user_info_sess')['LastName'] }}
                                                                &nbsp;({{ Session::get('user_role_sess')['RoleName'] }})</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item text-danger" href="javascript:void();" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> {{ __('Logout') }} </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

            {{-- change theme --}}
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="bx bx-cog bx-spin"></i>
                </button>
            </div>
            
        </div>
    </div>
</header>