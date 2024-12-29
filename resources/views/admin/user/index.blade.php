@extends('admin.layouts.master')
@section('title', 'All User List')

@push('style')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
@endpush

@section('breadcrumb-title')
    <h1>All User List</h1>
@stop

@section('breadcrumb-items')
    <li class="breadcrumb-item" aria-current="page">{{ __('User List')}}</li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Index')}}</li>
@stop

@section('content')
    @include('admin.components.breadcrumb')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{route('admin.user.add')}}" class="btn btn-primary add-item">{{ __('Add User')}} <i class="fa fa-plus" aria-hidden="true"></i></a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tech-data-table" class="tech-data-table table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th> 
                                    <th>Email</th>
                                    <th>Mobile No</th> 
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script> <!-- CSV, Excel, PDF export -->
 
<script>
$(document).ajaxComplete(function(){
    $(".confirm-delete").click(function(){
        var id = $(this).attr("data-id");
            var url = "{{ route('admin.user.delete',['id']) }}";
            url = url.replace('id',id);
        deletePopUp(url)
    });
});
$(function () {
    var table = $('.tech-data-table').DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "buttons": [
            "copy", 
            "csv", 
            "excel", 
            "pdf"
        ],
        "dom": 'Bfrtip',
        processing: true,
        serverSide: false,
        ajax: "{{ route('admin.user.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'contact_no', name: 'contact_no'}, 
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action'},
        ]
    });
    table.buttons().container().appendTo('#tech-data-table .col-md-6:eq(0)');
});

</script>
@endpush