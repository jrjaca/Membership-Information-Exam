@extends('layouts.master')

@section('title') Create User @endsection

@section('css') 
        <!-- DataTables -->        
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}">
@endsection

@section('content')

    @component('common-components.breadcrumb')
        @slot('title') USER MANAGEMENT @endslot
        @slot('li_1') <a title="Back to Home" href="{{route('index')}}">Home</a> @endslot
        @slot('li_2') Add User @endslot
    @endcomponent 

    <!-- Start Display Message-->
    @include('layouts.flash-message')
    <!-- END Display Message-->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {{-- @can('department_store')
                            <div style="float: left;">                            
                                <button class="btn btn-outline-primary btn-sm waves-effect waves-light" onclick="addDepartment()">Add New</button>
                                <br/><br/>
                            </div>
                        @endcan     --}}

                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                                <tbody>

                                @foreach($users as $key => $urow)                                      
                                    @php
                                        if ($urow->IsActive == "true")
                                            $statusDesc = "Active" ;
                                        else  
                                            $statusDesc = "Inactive";
                                                                                
                                        if ($urow->RoleId == "R1")
                                            $roleDesc = "Administrator";
                                        elseif ($urow->RoleId == "R2")  
                                            $roleDesc = "Supervisor";
                                        else
                                            $roleDesc = "Encoder";                                        
                                    @endphp    

                                    <tr>
                                        <td>{{ $key +1 }}</td>
                                        <td>{{ $urow->UserId }}</td>
                                        <td>{{ $urow->FirstName }}</td>
                                        <td>{{ $urow->LastName }}</td>
                                        <td>{{ $urow->Email }}</td>
                                        <td>{{ $statusDesc }}</td>
                                        <td>{{ $roleDesc }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <form id="my_form" action="{{ route('user.save') }}" method="POST" class="needs-validation" novalidate>                       
                        @csrf
                        <div class="modal-body">
                            
                            
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="UserId">UserID</label>
                                    <input type="text" class="form-control" name="UserId"  placeholder="UserId" required autofocus>
                                    <div class="invalid-feedback">
                                        Please provide userid.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Password">Password</label>
                                    <input type="password" class="form-control" name="Password"  placeholder="Password" required>
                                    <div class="invalid-feedback">
                                        Please provide password.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="FirstName">FirstName</label>
                                    <input type="text" class="form-control" name="FirstName"  placeholder="FirstName" required>
                                    <div class="invalid-feedback">
                                        Please provide first name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="LastName">LastName</label>
                                    <input type="text" class="form-control" name="LastName"  placeholder="LastName" required>
                                    <div class="invalid-feedback">
                                        Please provide last name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Email">Email</label>
                                    <input type="email" class="form-control" name="Email"  placeholder="Email" required>
                                    <div class="invalid-feedback">
                                        Please provide valid email address.
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="RoleId">Role</label>
                                    <select class="form-control select2-search-disable" name="RoleId"
                                            data-placeholder="Select..."  required style="width: 100%"> <!--select2-search-disable-->
                                        <option value="">Select...</option>
                                        <option value="R1">Administrator</option>
                                        <option value="R2">Supervisor</option>
                                        <option value="R3">Encoder</option>
                                    </select>

                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
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
