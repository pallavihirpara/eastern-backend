@extends('admin.layouts.master')
@section('title', 'All Role List')

@push('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
@endpush

@section('breadcrumb-title')
    <h1>All Role List</h1>
@stop

@section('breadcrumb-items')
    <li class="breadcrumb-item" aria-current="page">{{ __('Role List')}}</li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Index')}}</li>
@stop

@section('content')
    @include('admin.components.breadcrumb')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{route('admin.role.add')}}" class="btn btn-primary add-item">{{ __('Add Role')}} <i class="fa fa-plus" aria-hidden="true"></i></a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="role-data-table" class="role-data-table table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th> 
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

<script>
$(document).ajaxComplete(function(){
    $(".confirm-delete").click(function(){
        var id = $(this).attr("data-id");
            var url = "{{ route('admin.role.delete',['id']) }}";
            url = url.replace('id',id);
        deletePopUp(url)
    });
});
$(function () {
    var table = $('.role-data-table').DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        processing: true,
        serverSide: false,
        ajax: "{{ route('admin.role.index') }}",
        columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'name', name: 'name'},
        {data: 'action', name: 'action'},
        ]
    }).buttons().container().appendTo('#role-data-table .col-md-6:eq(0)');
});
</script>
@endpush