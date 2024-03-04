<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                <li>
                    <a href="{{ route('index') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i><span class="badge badge-pill badge-info float-right"></span>
                        <span>Home</span>
                    </a>
                </li>

                @if (Session::get('user_info_sess')['RoleId'] == "R1")
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-user"></i>
                            <span>User Management</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('user.create')}}">Create User</a></li>
                            <li><a href="{{route('user.list')}}">Edit User</a></li>  
                        </ul>
                    </li>
                @endif 
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-street-view"></i>
                        <span>Profile Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @if (Session::get('user_info_sess')['RoleId'] == "R1" || Session::get('user_info_sess')['RoleId'] == "R2" || Session::get('user_info_sess')['RoleId'] == "R3") 
                            <li><a href="{{route('password.change.x')}}">Change Password</a></li>   
                        @endif  
                    </ul>
                </li>

                @if (Session::get('user_info_sess')['RoleId'] != "R1")
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-user"></i>
                            <span>Member Management</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if (Session::get('user_info_sess')['RoleId'] == "R2")
                                <li><a href="{{route('member.create')}}">Create Member</a></li>
                            @endif   
                            @if (Session::get('user_info_sess')['RoleId'] == "R3") 
                                <li><a href="{{route('member.list')}}">Edit Member</a></li>   
                            @endif 
                        </ul>
                    </li>   
                @endif  


                {{-- Automatic Slideshow Banner --}}
                <div class="w3-content w3-section" style="position: absolute; bottom: 0; width: 100%;">
                    <img class="mySlides" src="{{ asset('assets/images/banner/b1.jpg') }}" style="width:100%">
                    <img class="mySlides" src="{{ asset('assets/images/banner/b2.jpg') }}" style="width:100%">
                    <img class="mySlides" src="{{ asset('assets/images/banner/b3.jpg') }}" style="width:100%">
                    <img class="mySlides" src="{{ asset('assets/images/banner/b4.jpg') }}" style="width:100%">
                    <img class="mySlides" src="{{ asset('assets/images/banner/b5.jpg') }}" style="width:100%">
                </div>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->