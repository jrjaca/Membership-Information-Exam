@extends('layouts.master')

@section('title') Edit User @endsection

@section('css') 
        <!-- DataTables -->        
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}">
@endsection

@section('content')

    @component('common-components.breadcrumb')
        @slot('title') USER MANAGEMENT @endslot
        @slot('li_1') <a title="Back to Home" href="{{route('index')}}">Home</a> @endslot
        @slot('li_2') Edit User @endslot
    @endcomponent 

    <!-- Start Display Message-->
    @include('layouts.flash-message')
    <!-- END Display Message-->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form id="my_form" action="{{ route('user.update') }}" method="POST" class="needs-validation" novalidate>                       
                        @csrf
                        <div class="modal-body">
                                                        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="UserId">UserID</label>
                                    <input type="text" class="form-control" name="UserId" placeholder="UserId" required autofocus readonly value={{ $user_info_arr['UserId'] }}>
                                    <div class="invalid-feedback">
                                        Please provide userid.
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="UserId">Password</label>
                                    <input type="password" class="form-control" name="Password"  placeholder="Password" required value={{ $user_info_arr['UserId'] }}>
                                    <div class="invalid-feedback">
                                        Please provide password.
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="FirstName">FirstName</label>
                                    <input type="text" class="form-control" name="FirstName"  placeholder="FirstName" required value={{ $user_info_arr['FirstName'] }}>
                                    <div class="invalid-feedback">
                                        Please provide first name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="LastName">LastName</label>
                                    <input type="text" class="form-control" name="LastName"  placeholder="LastName" required value={{ $user_info_arr['LastName'] }}>
                                    <div class="invalid-feedback">
                                        Please provide last name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Email">Email</label>
                                    <input type="email" class="form-control" name="Email"  placeholder="Email" required value={{ $user_info_arr['Email'] }}>
                                    <div class="invalid-feedback">
                                        Please provide valid email address.
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="IsActive">Status</label>
                                    <select class="form-control select2-search-disable" name="IsActive"
                                            data-placeholder="Select..."  required style="width: 100%"> <!--select2-search-disable-->

                                        @if($user_info_arr['IsActive'] == "true")
                                            <option value="true" selected>Active</option>
                                            <option value="false">Inactive</option>
                                        @else
                                            <option value="true">Active</option>
                                            <option value="false" selected >Inactive</option>
                                        @endif

                                    </select>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="RoleId">Role</label>
                                    <select class="form-control select2-search-disable" name="RoleId"
                                            data-placeholder="Select..."  required style="width: 100%"> <!--select2-search-disable-->

                                        @if($user_info_arr['RoleId'] == "R1")
                                            <option value="R1" selected>Administrator</option>
                                            <option value="R2">Supervisor</option>
                                            <option value="R3">Encoder</option>
                                        @elseif($user_info_arr['RoleId'] == "R2")
                                            <option value="R1">Administrator</option>
                                            <option value="R2" selected>Supervisor</option>
                                            <option value="R3">Encoder</option>
                                        @else
                                            <option value="R1">Administrator</option>
                                            <option value="R2">Supervisor</option>
                                            <option value="R3" selected>Encoder</option>
                                        @endif

                                    </select>

                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- end row -->        
@endsection

@section('script')

        <!-- Plugins js -->
        <script src="{{ URL::asset('assets/libs/datatables/datatables.min.js')}}"></script>
        <!-- Init js-->
        <script src="{{ URL::asset('assets/js/pages/datatables.init.js')}}"></script> 

@endsection

@section('script-bottom')

    <script src="{{ URL::asset('assets/libs/parsleyjs/parsleyjs.min.js') }}"></script> 
    <!-- Plugins js -->
    <script src="{{ URL::asset('assets/js/pages/form-validation.init.js') }}"></script> 

@endsection
