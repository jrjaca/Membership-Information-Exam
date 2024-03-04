@extends('layouts.master')

@section('title') Create Member @endsection

@section('css') 
        <!-- DataTables -->        
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}">
@endsection

@section('content')

    @component('common-components.breadcrumb')
        @slot('title') MEMBER MANAGEMENT @endslot
        @slot('li_1') <a title="Back to Home" href="{{route('index')}}">Home</a> @endslot
        @slot('li_2') Add Member @endslot
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
                                        <th>Member ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Birthdate</th>
                                        <th>Member Category</th>
                                    </tr>
                                </thead>
                                <tbody>

                                @foreach($members as $key => $mrow)                                      
                                    @php
                                        if ($mrow->MemberCategoryId == "MC#1")
                                            $memCatDesc = "Direct Contributors" ;
                                        else  
                                            $memCatDesc = "Indirect Contributors";                                                                            
                                    @endphp    
                                    <tr>
                                        <td>{{ $key +1 }}</td>
                                        <td>{{ $mrow->MemberId }}</td>
                                        <td>{{ $mrow->FirstName }}</td>
                                        <td>{{ $mrow->LastName }}</td>
                                        <td>{{ $mrow->Birthdate }}</td>
                                        <td>{{ $memCatDesc }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <form id="my_form" action="{{ route('member.save') }}" method="POST" class="needs-validation" novalidate>                       
                        @csrf
                        <div class="modal-body">
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="MemberId">MemberId</label>
                                    <input type="text" class="form-control" name="MemberId"  placeholder="MemberId" required autofocus>
                                    <div class="invalid-feedback">
                                        Please provide MemberId.
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
                                    <label for="Birthdate">Birthdate</label>
                                    <input type="text" class="form-control" name="Birthdate"  placeholder="Birthdate" required>
                                    <div class="invalid-feedback">
                                        Please provide birthdate.
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="MemberCategoryId">Member Category Id</label>
                                    <select class="form-control select2-search-disable" name="MemberCategoryId"
                                            data-placeholder="Select..."  required style="width: 100%"> 
                                        <option value="">Select...</option>
                                        <option value="MC#1">Direct Contributors</option>
                                        <option value="MC#2">Indirect Contributors</option>
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
