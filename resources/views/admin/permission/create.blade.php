@extends('admin.layouts.master')
@section('title', 'Add Permission')

@section('breadcrumb-title')
    <h1>{{isset($permission) ? 'Edit' : 'Add'}} Permission</h1>
    <a href="{{ route('admin.permission.index') }}" tooltip="Permission List" class="badge badge-secondary"><i class="fa fa-arrow-left"></i></a>
    <span>{{ __('Back')}}</span>
@stop
@section('breadcrumb-items')
    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.permission.index') }}" class="show-item">{{ __('Permission')}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">
        @if(isset($permission))
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
            <form role="form" class="forms-sample row submit-permission" method="POST" autocomplete="off">
                @csrf
                <div class="form-group col-md-12"> 
                    <label for="customFile">Role</label>
                    <select name="role_id" class="form-control" id="role" required>
                        @foreach($roles as $role)
                        <option value="{{$role->id}}" {{ old('state', $permission->id ?? '') == $role->id ? 'selected' : '' }}>{{$role->name}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger role"></span>
                <div>
                    @php
                    $permissionList = !empty($permission) ? $permission->permissions->pluck('name')->toArray() : [];
                    @endphp 
                <div class="form-group p-0 mt-3 mb-0">
                    <label for="customFile">Permissions</label>
                    <div class="input-group justify-content-between w-75 d-flex" id="permission">
                        <label>
                            <input type="checkbox" class="check_hobby" name="permission" value="View" {{ isset($permission) ? in_array('View', $permissionList) ? 'checked' : '' : '' }}> View
                        </label>
                        <label>
                            <input type="checkbox" class="check_hobby" name="permission" value="Create" {{ isset($permission) ? in_array('Create', $permissionList) ? 'checked' : '' : '' }}> Create
                        </label>
                        <label>
                            <input type="checkbox" class="check_hobby" name="permission" value="Edit" {{ isset($permission) ? in_array('Edit', $permissionList) ? 'checked' : '' : '' }}> Edit
                        </label>
                        <label>
                            <input type="checkbox" class="check_hobby" name="permission" value="Delete" {{ isset($permission) ? in_array('Delete', $permissionList) ? 'checked' : '' : '' }}> Delete
                        </label>
                    </div>
                    <span class="text-danger permission"></span>
                </div>
                <button type="submit" class="btn btn-primary add-item">{{ __('Submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('script')

    <script type="text/javascript">
        $(document).ready(function(){ 
            $(".submit-permission").on('submit', function (e) {
                e.preventDefault();

                if ($("#name").val() == "") {
                    $(".name").html("Please enter permission name.");
                } 
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });  
                const checkboxes = document.querySelectorAll('input[name="permission"]:checked');
                let selectedHobby = [];
                checkboxes.forEach((checkbox) => {
                    selectedHobby.push(checkbox.value);
                }); 
                let hasError = false;

                if ($("#role_id").val() == "") {
                    $(".role_id").html("Please choose role.");
                    hasError = true;
                }
                if (selectedHobby.length == 0) {
                    $(".permission").html("Please choose any permission.");
                    hasError = true;
                }
                if (hasError) {
                    return; 
                }

                $(".role_id").html();
                $(".permission").html();

                let formData = new FormData();
                formData.append('role_id', $("#role").val());
                formData.append('permission', selectedHobby);
            
                let id = "{{ request()->route('id') ? request()->route('id') : '' }}";
                var url = "{{ route('admin.permission.update', ['id']) }}";
                $('#loader').css('display', 'flex');
              
                if (id) {
                    formData.append('id', id);
                    url = url.replace('id', id);
                } else {
                    url = "{{ route('admin.permission.store') }}"; // Fallback for creating a new permission
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
                            toastr.success('Permission added successfully.');
                            window.location.href = "{{ route('admin.permission.index') }}";
                        }
                    },
                    error: function (xhr) {
                        $('#loader').css('display', 'none');
                        var errors = xhr.responseJSON.errors;
                        console.log("errors", errors);

                        if (errors.name) {
                            $(".role_id").html(errors.name[0]);
                        }
                        if (errors.name) {
                            $(".permission").html(errors.name[0]);
                        }
                    }
                });
            });  
        })
    </script>
@endpush
