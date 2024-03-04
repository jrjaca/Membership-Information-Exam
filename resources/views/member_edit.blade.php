@extends('layouts.master')

@section('title') Edit Member @endsection

@section('css') 
        <!-- DataTables -->        
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}">
@endsection

@section('content')

    @component('common-components.breadcrumb')
        @slot('title') MEMBER MANAGEMENT @endslot
        @slot('li_1') <a title="Back to Home" href="{{route('index')}}">Home</a> @endslot
        @slot('li_2') Edit Member @endslot
    @endcomponent 

    <!-- Start Display Message-->
    @include('layouts.flash-message')
    <!-- END Display Message-->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form id="my_form" action="{{ route('member.update') }}" method="POST" class="needs-validation" novalidate>                       
                        @csrf
                        <div class="modal-body">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="MemberId">Member Id</label>
                                    <input type="text" class="form-control" name="MemberId" placeholder="" required autofocus readonly value={{ $user_info_arr['MemberId'] }}>
                                    <div class="invalid-feedback">
                                        Please provide MemberId.
                                    </div>
                                </div>
                            </div>
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
                                    <label for="Birthdate">Birthdate</label>
                                    <input type="text" class="form-control" name="Birthdate"  placeholder="" required value={{ $user_info_arr['Birthdate'] }}>
                                    <div class="invalid-feedback">
                                        Please provide Birthdate.
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="MemberCategoryId">Member Category</label>
                                    <select class="form-control select2-search-disable" name="MemberCategoryId"
                                            data-placeholder="Select..."  required style="width: 100%"> <!--select2-search-disable-->

                                        @if($user_info_arr['MemberCategoryId'] == "MC#1")
                                            <option value="MC#1" selected>Direct Contributors</option>
                                            <option value="MC#2">Indirect Contributors</option>
                                        @else
                                            <option value="MC#1">Direct Contributors</option>
                                            <option value="MC#2" selected >Indirect Contributors</option>
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
