@extends('layouts.master')

@section('title') Home @endsection

@section('content')

    @component('common-components.breadcrumb')
        @slot('title') Home  @endslot
        @slot('li_1') @endslot
        {{-- Welcome to {{env('APP_NAME')}}  --}}
    @endcomponent


                        <div class="row">
                            <div class="col-xl-4">
                                {{--  --}}
                            </div>
                            <div class="col-xl-8">
                                <div class="row">

    

@endsection

@section('script')
        <!-- plugin js -->
        <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>

        <!-- Calendar init -->
        <script src="{{ URL::asset('assets/js/pages/dashboard.init.js')}}"></script>
@endsection