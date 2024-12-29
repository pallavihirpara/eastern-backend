@extends('admin.layouts.master')
@section('title', 'Add Role')

@section('breadcrumb-title')
    <h1>{{isset($role) ? 'Edit' : 'Add'}} Role</h1>
    <a href="{{ route('admin.user.index') }}" tooltip="Role List" class="badge badge-secondary"><i class="fa fa-arrow-left"></i></a>
    <span>{{ __('Back')}}</span>
@stop
@section('breadcrumb-items')
    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.user.index') }}" class="show-item">{{ __('Role')}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">
        @if(isset($role))
            {{ __('Edit') }}
        @else
            {{ __('Add') }}
        @endif
    </li>
@stop
@section('content')
@include('admin.components.breadcrumb')

<div class="container-fluid">
    <div class="col-md-6">
        <div class="card card-body"> 
            <form role="form" class="forms-sample row submit-role" method="POST" autocomplete="off">
                @csrf
                <div class="form-group col-md-12">
                    <label for="title">{{ __('Role Name')}}</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Role Name" value="{{ isset($role) ? $role->name : old('name') }}">
                    <span class="text-danger name"></span>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary add-item ml-2">{{ __('Submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('script')

    <script type="text/javascript">
        $(document).ready(function(){ 
            $(".submit-role").on('submit', function (e) {
                e.preventDefault();

                if ($("#name").val() == "") {
                    $(".name").html("Please enter role name.");
                } 
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });  
                $('#loader').css('display', 'flex');

                let formData = new FormData();
                formData.append('name', $('#name').val());
            
                let id = "{{ request()->route('id') ? request()->route('id') : '' }}";
                var url = "{{ route('admin.role.update', ['id']) }}";
              
                if (id) {
                    formData.append('id', id);
                    url = url.replace('id', id);
                } else {
                    url = "{{ route('admin.role.store') }}"; // Fallback for creating a new user
                }
                $.ajax({
                    url: url,  
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $('#loader').css('display', 'none');
                        if (response.status === 200) {
                            toastr.success('Role added successfully.');
                            window.location.href = "{{ route('admin.role.index') }}";
                        }
                    },
                    error: function (xhr) {
                        $('#loader').css('display', 'none');
                        var errors = xhr.responseJSON.errors;
                        console.log("errors", errors);

                        if (errors.name) {
                            $(".name").html(errors.name[0]);
                        }
                    }
                });
            });  
        })
    </script>
@endpush
