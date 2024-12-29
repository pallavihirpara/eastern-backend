@extends('admin.layouts.master')
@section('title', 'Update Profile')

@section('breadcrumb-title')
    <h1>Update Profile</h1>
@stop
@section('breadcrumb-items')
    <li class="breadcrumb-item" aria-current="page"><a href="javascript:void(0);" class="show-item">{{ __('Update Profile')}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Add')}}</li>
@stop
@section('content')
@include('admin.components.breadcrumb')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-body">
                        <form class="forms-sample" action="{{ route('admin.update_profile.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="first_name">{{ __('Name')}}</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Your Name" value="{{ $user->en_name }}">
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="last_name">{{ __('Email')}}</label>
                                    <input type="text" class="form-control" name="email" placeholder="Enter Your Email" value="{{ $user->email }}">
                                    <span class="text-danger">{{$errors->first('email')}}</span>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="email_address">{{ __('Mobile No')}}</label>
                                    <input type="text" class="form-control" name="mobile_no" placeholder="Enter Your Mobile No" value="{{ $user->mobile_no }}">
                                    <span class="text-danger">{{$errors->first('mobile_no')}}</span>
                                </div>
                                {{-- <div class="col-md-12 d-flex"> --}}
                                    {{-- <div class="form-group col-md-8 pl-0">
                                        <label for="email_address">{{ __('Profile')}}</label>
                                        <input type="file" class="form-control" name="profile">
                                        <span class="text-danger">{{$errors->first('profile')}}</span>
                                    </div>
                                </div> --}}
                                <div class="col-md-12">
                                    <label for="email_address">{{ __('Profile')}}</label>
                                    <div class="input-group pl-0 pr-0">
                                        <input type="file" class="form-control" id="image" onchange="readURL(this);" name="profile">
                                        <label class="input-group-text" for="image">Choose File</label>
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 mb-2 mt-3">
                                    <div class="form-group col-md-12 show-img">
                                        @if ($user->profile)
                                            <img src="{{asset('uploads/userProfile/'.$user->profile)}}" class="img-profile" height="90" width="120" alt="Avatar">
                                        @else
                                            <img src="{{asset('assets/admin/avtar.png')}}" class="img-profile" height="110" alt="Avatar">
                                        @endif
                                    </div>
                                    <div class="form-group col-md-12">
                                        <img id="blah" src="" height="100px" width="100px" alt="your image">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary add-item mr-2">{{ __('Save')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')

    <script type="text/javascript">
        $(document).ready(function() {
            $('#blah').hide();
            $('.show-img').show();
        });

        function readURL(input) {
            var fileName = document.getElementById("image").value;
            var idxDot = fileName.lastIndexOf(".") + 1;
            var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
            if (extFile=="jpg" || extFile=="jpeg" || extFile=="png" || extFile=="svg"){
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('.show-img').hide();
                        $('#blah').show();
                        $('#blah')
                            .attr('src', e.target.result)
                            .width(100)
                            .height(100);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }else{
                document.getElementById("image").value = null;
                $('#blah').attr('src', '')
                alert("Only jpg/jpeg Svg and png Image are allowed!");
            }
        }

    </script>
@endpush