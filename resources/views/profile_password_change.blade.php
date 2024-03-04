@extends('layouts.master')

@section('title') Change Password @endsection

@section('css') 
        <!-- DataTables -->        
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}">
@endsection

@section('content')

    @component('common-components.breadcrumb')
        @slot('title') PROFILE MANAGEMENT @endslot
        @slot('li_1') <a title="Back to Home" href="{{route('index')}}">Home</a> @endslot
        @slot('li_2') Change Password @endslot
    @endcomponent 

    <!-- Start Display Message-->
    @include('layouts.flash-message')
    <!-- END Display Message-->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    
                    <form id="my_form" action="{{ route('password.update.x') }}" method="POST" class="needs-validation" novalidate>                       
                        @csrf
                        <div class="modal-body">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="OldPassword">Old Password</label>
                                    <input type="password" class="form-control" name="OldPassword" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Please provide old password.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="NewPassword">New Password</label>
                                    <input type="password" class="form-control" name="NewPassword" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Please provide new password.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="RtNewPassword">Confirm New Password</label>
                                    <input type="password" class="form-control" name="RtNewPassword"  placeholder="" required>
                                    <div class="invalid-feedback">
                                        Please re-type new password.
                                    </div>
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
