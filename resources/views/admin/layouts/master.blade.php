<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="icon" href="{{ asset('assets/admin/logo.png')}}" />
        <title> @yield('title','') </title>
        <!-- Google Font: Source Sans Pro -->
        @include('admin.partials.css')
        
        <link rel="stylesheet" href="{{asset('/')}}assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="{{asset('/')}}assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="{{asset('/')}}assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
        <link rel="stylesheet" href="{{asset('/')}}assets/admin/adminstyle.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <style>
              #loader {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 9999;
            }

            .spinner {
                border: 8px solid #f3f3f3;
                border-top: 8px solid #3498db;
                border-radius: 50%;
                width: 60px;
                height: 60px;
                animation: spin 1s linear infinite;
            }

            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }
                100% {
                    transform: rotate(360deg);
                }
            }
            .text-danger{
            font-size: 9px;
            }
            .main-sidebar{
                height: auto !important;
                overflow: hidden !important;
            }
        </style>
        @stack('style')
    </head>
    <body class="hold-transition sidebar-mini">
        <!-- ./wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            @include('admin.partials.header')

            <!-- Main Sidebar Container -->
            @include('admin.partials.sidebar')
            {{-- @include('admin.delete-modal') --}}

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                @stack('breadcrumb')
               
                <!-- Main content -->
                <section class="content">
                    <div id="loader" style="display: none;">
                        <div class="spinner"></div>
                    </div>
                    @yield('content')
                    <!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            @include('admin.partials.footer')
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        @include('admin.partials.js')
        
        <!-- DataTables  & Plugins -->
        <script src="{{asset('/')}}assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="{{asset('/')}}assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="{{asset('/')}}assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="{{asset('/')}}assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="{{asset('/')}}assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="{{asset('/')}}assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="{{asset('/')}}assets/admin/plugins/jszip/jszip.min.js"></script>
        <script src="{{asset('/')}}assets/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="{{asset('/')}}assets/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <script>
            function deletePopUp(url){
                swal({
                    title: "Are you sure?",
                    text: "Do you really want to update status?",
                    icon: "warning",
                    position: 'left-top',
                    buttons: ["Cancel", "Yes"],
                    buttonsStyling: false,
                    dangerMode: true,
                    reverseButtons: true
                })
                .then((willDelete) => {
                    if (willDelete) { 
                        $.ajax({
                            url: url,
                            type: 'GET',
                            success: function(data) {
                                toastr.success('record deleted successfully');
                                setTimeout(function () {
                                    location.reload(true);
                                }, 300);
                            }
                        });
                    } else {
                        swal({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Thank You.!',
                            timer: 2000
                        })
                        $(".swal-footer").addClass("text-center");
                    }
                });
            }
        </script>
        @stack('script')
    </body>
</html>
