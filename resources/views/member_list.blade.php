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
        @slot('li_2') List of Users @endslot
    @endcomponent 

    <!-- Start Display Message-->
    @include('layouts.flash-message')
    <!-- END Display Message-->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
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
                                        <th>Action</th>
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
                                        <td>                                        
                                            <a href="{{ route('member.edit', ['id' => $mrow->MemberId]) }}" >
                                                <span style="font-size: 1.2em; color: Dodgerblue;">
                                                    <i class="fa fa-edit" title="Edit"></i>
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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
@endsection
