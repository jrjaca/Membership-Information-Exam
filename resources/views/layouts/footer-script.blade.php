        <!-- JAVASCRIPT -->
        <script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{ URL::asset('assets/libs/bootstrap/bootstrap.min.js')}}"></script>
        <script src="{{ URL::asset('assets/libs/metismenu/metismenu.min.js')}}"></script>
        <script src="{{ URL::asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{ URL::asset('assets/libs/node-waves/node-waves.min.js')}}"></script>

@yield('script')

        <!-- App js -->
        <script src="{{ URL::asset('assets/js/app.min.js')}}"></script>
        
        <!-- toastr plugin -->
        <script src="{{ URL::asset('assets/libs/toastr/toastr.min.js') }}"></script>
        {{-- <!-- toastr init -->
        <script src="{{ URL::asset('assets/libs/toastr/toastr.init.js') }}"></script> --}}

        {{--<!-- Sweetalert2 - for Swal of TOAST-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>--}}
        <script src="{{ URL::asset('assets/libs/sweetalert2forswaloftoast-jaca/sweetalert2forswaloftoast-jaca.js') }}"></script>
        <!-- toastr -->
        <script>
                @if(Session::has('message'))
                toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": 600,
                        "hideDuration": 1000,
                        "timeOut": 5000,
                        "extendedTimeOut": 1000,
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                }

                const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        showCloseButton: true,
                        timer: 6000,
                        timerProgressBar: true,
                        onOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                });

                var type="{{Session::get('alert-type','info')}}"
                if (type == 'success') {
                        Toast.fire({
                                icon: 'success',
                                title: "{{ Session::get('message') }}" })
                } else if (type == 'info') {
                        Toast.fire({
                                icon: 'info',
                                title: "{{ Session::get('message') }}" })
                } else if (type == 'warning') {
                        Toast.fire({
                                icon: 'warning',
                                title: "{{ Session::get('message') }}" })
                } else {
                        Toast.fire({
                                icon: 'error',
                                title: "{{ Session::get('message') }}" })}
                @endif
        </script>

        <!--spinner/waiting MAIN GLOBAL USE - NOT THE DEFAULT-->
        <script src="{{ URL::asset('spinner/js/modal-loading.js') }}"></script>
        <script>
                function spinner(tile) {
                        var loading = Loading({
                                title: tile,
                                titleColor: 'rgb(255, 255, 255)',
                                loadingAnimation: 'image',
                                animationSrc: "{{url('spinner')}}/img/loading.gif",
                                animationWidth: 150,
                                animationHeight: 100,
                                defaultApply: true,
                        });
                        loading.out(); //hide immediately
                }
        </script>

                {{-- trigger spinner - saving, update, etc for FORMS--}}
                <script type="text/javascript">
                        $(document).ready(function() {
                                $('#my_form').on('submit', function() {                
                                        spinner('Loading...');
                                });
                        });
                </script> 
                
@yield('script-bottom')        

        <!-- About Details -->
        <script>        
                function about(){
                        spinner('Loading...');
                        $.ajax({
                                type:"GET",
                                url: "{{ url('about/') }}",  
                                dataType: "json",
                                cache: false,
                                success: function(result){
                                        //alert(JSON.stringify(result));
                                        //alert(JSON.stringify(result.enabled_roles));
                                        //alert(result.user_details.username);
                                        //------ result[0] = Get the first only ---------//

                                        var location =  result.office[0].title+", "+result.department[0].title+", "+result.section[0].title;
                                        $('#role_desc_profile').html(result.role[0].title);
                                        $('#location_desc_profile').html(location);

                                        // Display Modal
                                        $('#aboutModal').modal('show');
                                },
                                        error: function (request, status, error) {
                                                //alert(request.responseText);
                                },
                        });
                }
        </script>
        <!-- /About Details -->
        
        {{-- in replace to onload function at body --}}
        <script>
                document.addEventListener("DOMContentLoaded", function(event) {
                        display_ct();
                });
        </script>
        <!-- /Display dynamic current date and time at any blade-->

        {{-- Banner / Slides --}}
        <script>
                var myIndex = 0;
                carousel();
                
                function carousel() {
                        var i;
                        var x = document.getElementsByClassName("mySlides");
                        for (i = 0; i < x.length; i++) {
                        x[i].style.display = "none";  
                        }
                        myIndex++;
                        if (myIndex > x.length) {myIndex = 1}    
                        x[myIndex-1].style.display = "block";  
                        setTimeout(carousel, 2800); // Change image every 2.8 seconds
                }
        </script>