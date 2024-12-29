<script src="{{asset('/')}}assets/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/')}}assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('/')}}assets/admin/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('/')}}assets/admin/dist/js/demo.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.0/js/dataTables.buttons.min.js"></script>

<script>
    @if(Session::has('success'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
        toastr.success("{{ session('success') }}");
    @endif

    @if(Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
        toastr.error("{{ session('error') }}");
    @endif

    @if(Session::has('info'))
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
        toastr.info("{{ session('info') }}");
    @endif

    @if(Session::has('warning'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
        toastr.warning("{{ session('warning') }}");
    @endif
</script>
<link rel="stylesheet" href="{{asset('/')}}assets/admin/custom.js">

<script>
    $('.click_head').on('click', function(event) {
        if($('body').attr('class') != "sidebar-mini sidebar-collapse"){
            $(".side_logo").removeClass("ml-5");
            $(".side_logo").removeClass("mr-5");
            $(".side_logo").css({"margin-left":"-10px","width":"50"});
        }else{
            $(".side_logo").addClass("ml-5");
            $(".side_logo").addClass("mr-5");  
            $(".side_logo").css({"width":"90"});
        }
    });
    
    // $(".sidebar-mini.sidebar-collapse .main-sidebar.sidebar-focused,.sidebar-mini.sidebar-collapse .main-sidebar").hover( 
    //     alert("hello");
    // );
</script>