<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name')}} | Log in</title>
        <link rel="icon" href="{{asset('/')}}" type="image/x-icon" />
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('/')}}assets/admin/logo.png" />
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('/')}}ablankssets/admin/plugins/fontawesome-free/css/all.min.css" />
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="{{asset('/')}}assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css" />
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('/')}}assets/admin/dist/css/adminlte.min.css" />
        <link rel="stylesheet" href="{{asset('/')}}assets/admin/adminstyle.css" />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">       
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="javascript:void(0);">
                    <img src="{{asset('assets/admin/logo.png')}}">
                </a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign in to start your session</p>
                    <div class="col-md-12">
                        @if (session('error'))
                            <span style="color: red">{{ session('error') }}</span>
                        @endif
                    </div>
                    <div id="loader" style="display: none;">
                      <div class="spinner"></div>
                  </div>
                    <form role="form" id="submitLogin" method="post"> 
                        <div class="input-group mb-3">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email" required autocomplete="email" autofocus />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            <span class="text-danger input-group my-2" id="email"></span>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            <span class="text-danger input-group my-2" id="password"></span>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <a href="{{ route('forget.password.get') }}" class="text-dark">Forgot Password?</a>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block add-item">Sign In</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    {{-- <p class="mb-1"></p> --}}

                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="{{asset('/')}}assets/admin/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="{{asset('/')}}assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('/')}}assets/admin/dist/js/adminlte.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#submitLogin").on('submit',function(e){
                e.preventDefault();
        
                var formData = $(this).serialize();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                $('#loader').css('display', 'flex');
                $("#email").html()
                $("#password").html()
                $.ajax({
                    url: "{{route('login.post')}}",
                    method: 'POST',
                    data: formData,
                    success: function(response) { 
                    if(response.status === 200){
                        $('#loader').css('display', 'none');
                        toastr.success('Login successfully.'); 
                        window.location.href = "{{route('admin.dashboard')}}"
                    }
                    console.log("response",response); 
                    },
                    error: function(xhr) {
                    $('#loader').css('display', 'none');
                        var errors = xhr.responseJSON.errors;
                        if(errors.email){
                        $("#email").html(errors.email[0])
                        }
                        if(errors.password){
                        $("#password").html(errors.password[0])
                        }
                    }
                });
            })
            })
    </script>
    </body>
</html>
