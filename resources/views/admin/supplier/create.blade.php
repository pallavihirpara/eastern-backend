@extends('admin.layouts.master')
@section('title', 'Add Supplier')

@section('breadcrumb-title')
    <h1>{{isset($supplier) ? 'Edit' : 'Add'}} Supplier</h1>
    <a href="{{ route('admin.supplier.index') }}" tooltip="Supplier List" class="badge badge-secondary"><i class="fa fa-arrow-left"></i></a>
    <span>{{ __('Back')}}</span>
@stop
@section('breadcrumb-items')
    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.supplier.index') }}" class="show-item">{{ __('Supplier')}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">
        @if(isset($supplier))
            {{ __('Edit') }}
        @else
            {{ __('Add') }}
        @endif
    </li>
@stop
@section('content')
@include('admin.components.breadcrumb')
{{-- user
permissions --}}
<div class="container-fluid">
    <div class="col-md-6">
        <div class="card card-body"> 
            
            @if(($user->hasRole('Supplier') && in_array('Create', $permissions) || isset($supplier) ?? in_array('Edit', $permissions)) || $user->hasRole('Admin') || $user->hasRole('User'))
            <form supplier="form" class="forms-sample row submit-supplier" method="POST" autocomplete="off">
                @csrf
                <div class="form-group col-md-12">
                    <label for="title">{{ __('Supplier Name')}}</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Supplier Name" value="{{ isset($supplier) ? $supplier->name : old('name') }}">
                    <span class="text-danger name"></span>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary add-item ml-2">{{ __('Submit')}}</button>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection
@push('script')

    <script type="text/javascript">
        $(document).ready(function(){ 
            $(".submit-supplier").on('submit', function (e) {
                e.preventDefault();

                if ($("#name").val() == "") {
                    $(".name").html("Please enter name.");
                } 
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });  

                let formData = new FormData();
                formData.append('name', $('#name').val());
            
                let id = "{{ request()->route('id') ? request()->route('id') : '' }}";
                var url = "{{ route('admin.supplier.update', ['id']) }}";
              
                if (id) {
                    formData.append('id', id);
                    url = url.replace('id', id);
                } else {
                    url = "{{ route('admin.supplier.store') }}";
                }
                $('#loader').css('display', 'flex');

                $.ajax({
                    url: url,  
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $('#loader').css('display', 'none');
                        if (response.status === 200) {
                            toastr.success('Supplier added successfully.');
                            window.location.href = "{{ route('admin.supplier.index') }}";
                        }
                    },
                    error: function (xhr) {
                        $('#loader').css('display', 'none');
                        var errors = xhr.responseJSON.errors;
                        if (errors?.name) {
                            $(".name").html(errors.name[0]);
                        }
                    }
                });
            });  
        })
    </script>
@endpush
