
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
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
                    <h5 class="login-box-msg">Reset Password</h5>
                    <div class="col-md-12">
                                            </div>
                    <form action="{{route('forget.password.post')}}" method="post" autocomplete="off">
                        <input type="hidden" name="_token" value="byat0y7frZXUYLqCmAK6xxignPtKw49tfDlBHeob">                        <div class="input-group mb-3">
                            <input type="email" id="email" name="email" class="form-control " placeholder="Email" required autocomplete="email" autofocus value="" />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                                                    </div>
                        <div class="row">
                            <div class="offset-3 col-6">
                                <button type="submit" class="btn btn-primary btn-block add-item">Reset Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

               <!-- jQuery -->
               <script src="{{asset('/')}}assets/admin/plugins/jquery/jquery.min.js"></script>
               <!-- Bootstrap 4 -->
               <script src="{{asset('/')}}assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
               <!-- AdminLTE App -->
               <script src="{{asset('/')}}assets/admin/dist/js/adminlte.min.js"></script>
    </body>
</html>
