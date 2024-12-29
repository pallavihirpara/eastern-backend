@extends('admin.layouts.master')
@section('title', 'Add User')

@section('breadcrumb-title')
    <h1>{{isset($user) ? 'Edit' : 'Add'}} User</h1>
    <a href="{{ route('admin.user.index') }}" tooltip="User List" class="badge badge-secondary"><i class="fa fa-arrow-left"></i></a>
    <span>{{ __('Back')}}</span>
@stop
@section('breadcrumb-items')
    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.user.index') }}" class="show-item">{{ __('User')}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">
        @if(isset($user))
            {{ __('Edit') }}
        @else
            {{ __('Add') }}
        @endif
    </li>
@stop
@section('content')
@include('admin.components.breadcrumb')

<div class="container-fluid">
    <div class="col-md-12">
        <div class="card card-body"> 
            {{-- encrpted($user->id) --}}
            <form class="forms-sample row submit-user" method="POST" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="form-group col-md-6">
                    <label for="title">{{ __('First Name')}}</label>
                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter First Name" value="{{ isset($user) ? $user->first_name : old('first_name') }}">
                    <span class="text-danger first_name"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="title">{{ __('Last Name')}}</label>
                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter Last Name" value="{{ isset($user) ? $user->last_name : old('last_name') }}">
                    <span class="text-danger last_name"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="title">{{ __('Email')}}</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" value="{{ isset($user) ? $user->email : old('email') }}">
                    <span class="text-danger email"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="title">{{ __('Contact No')}}</label>
                    <input type="number" class="form-control" name="contact_no" id="contact_no" placeholder="Enter Contact No" value="{{ isset($user) ? $user->contact_no : old('contact_no') }}">
                    <span class="text-danger contact_no"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="title">{{ __('State')}}</label>
                    <input type="text" name="search" class="findState" value="">
                    <select name="state_id" class="form-control" id="state">
                        <option value="">Please select state</option>
                        {{-- @foreach($state as $s)
                        <option value="{{$s->id}}" {{ old('state', $user->state ?? '') == $s->id ? 'selected' : '' }}>{{$s->name}}</option>
                        @endforeach --}}
                    </select>
                    <span class="text-danger state"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="img">{{ __('City')}}</label>
                    <input type="text" name="search" class="findCity" value="">
                    <select name="city_id" class="form-control city-dropdown" id="city">
                    </select>
                    <span class="text-danger city"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="img">{{ __('Role')}}</label>
                    <select name="role_id" class="form-control" id="role">
                        @foreach($role as $r)
                        <option value="{{$r->id}}" {{ old('state', $user->role ?? '') == $r->id ? 'selected' : '' }}>{{$r->name}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger role"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="img">{{ __('Profile')}}</label>
                    <input type="file" name="files[]" id="profile" multiple class="form-control">
                    <span class="text-danger profile"></span>
                </div>
                @if(!empty($user))
                <div class="form-group col-md-6"></div>
                <div class="form-group col-md-6">
                    @foreach($user_images as $user_image)
                    <img src="{{asset('uploads/user/'.$user_image->name)}}" width="50" alt="" srcset="">
                    @endforeach
                </div>
                @endif
                <div class="form-group col-md-12">
                    <label for="title">{{ __('Postcode')}}</label>
                    <input type="number" class="form-control" name="post_code" id="post_code" placeholder="Enter Postcode" value="{{ isset($user) ? $user->post_code : old('post_code') }}">
                    <span class="text-danger post_code"></span>
                </div> 
                @php
                   $user_hobby = (!empty($user) && $user->hobbies != null) ? json_decode($user->hobbies) : [];
                @endphp 
                <div class="form-group col-md-6">
                    <label for="customFile">Hobbies</label>
                    <div class="input-group justify-content-between w-75 d-flex" id="hobby">
                        <label>
                            <input type="checkbox" class="check_hobby" name="hobby" value="Reading" {{ isset($user) ? in_array('Reading', $user_hobby) ? 'checked' : '' : '' }}> Reading
                        </label>
                        <label>
                            <input type="checkbox" class="check_hobby" name="hobby" value="Sports" {{ isset($user) ? in_array('Sports', $user_hobby) ? 'checked' : '' : '' }}> Sports
                        </label>
                        <label>
                            <input type="checkbox" class="check_hobby" name="hobby" value="Traveling" {{ isset($user) ? in_array('Traveling', $user_hobby) ? 'checked' : '' : '' }}> Traveling
                        </label>
                        <label>
                            <input type="checkbox" class="check_hobby" name="hobby" value="Music" {{ isset($user) ? in_array('Music', $user_hobby) ? 'checked' : '' : '' }}> Music
                        </label>
                        <label>
                            <input type="checkbox" class="check_hobby" name="hobby" value="Photography" {{ isset($user) ? in_array('Photography', $user_hobby) ? 'checked' : '' : '' }}> Photography
                        </label>
                    </div>
                    <span class="text-danger hobby"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="customFile">Gender</label>
                    <div class="input-group" id="gender">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input check_gender" type="radio" name="gender" id="gender3" value="Male"  {{ isset($user) ? ($user->gender == 'Male') ? 'checked' : '' : 'checked' }}>
                            <label for="gender3" class="custom-control-label mr-3">Male</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input check_gender" type="radio" name="gender" id="gender1" value="Female" {{ isset($user) ? ($user->gender == 'Female') ? 'checked' : '' : '' }}>
                            <label for="gender1" class="custom-control-label mr-3">Female</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input check_gender" type="radio" name="gender" id="trans_gender" value="Trans Gender" {{ isset($user) ? ($user->gender == 'Trans Gender') ? 'checked' : '' : '' }}>
                            <label for="trans_gender" class="custom-control-label">Trans Gender</label>
                        </div>
                    </div>
                    
                    <span class="text-danger gender"></span>
                </div>
                <button type="submit" class="btn btn-primary add-item mr-2">{{ __('Submit')}}</button>
            </form>
        </div>
    </div>
</div>
@endsection
@push('script')

    <script type="text/javascript">
        $(document).ready(function(){
            getState() 
            let id = "{{isset($user) ? $user->state_id : ''}}"
            getCity(id)
            let user_id = "{{ request()->route('id') ? request()->route('id') : '' }}";
            
            $('#state').on('change', function () {
                let state_id = $(this).val()
                if(state_id != ""){
                    getCity(state_id)
                }
            })
            $(".submit-user").on('submit', function (e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                const checkboxes = document.querySelectorAll('input[name="hobby"]:checked');
                const radio = document.querySelector('input[name="gender"]:checked'); 
                let selectedHobby = [];
                checkboxes.forEach((checkbox) => {
                    selectedHobby.push(checkbox.value);
                }); 
                
                var fileInput = document.getElementById('profile');
                var files = fileInput.files; 
                let hasError = false;

                if ($("#first_name").val() == "") {
                    $(".first_name").html("Please enter first name.");
                    hasError = true;
                }
                if ($("#last_name").val() == "") {
                    $(".last_name").html("Please enter last name.");
                    hasError = true;
                }
                if ($("#email").val() == "") {
                    $(".email").html("Please enter email.");
                    hasError = true;
                }
                if ($("#contact_no").val() == "") {
                    $(".contact_no").html("Please enter contact no.");
                    hasError = true;
                }
                if ($("#state").val() == "") {
                    $(".state").html("Please enter state.");
                    hasError = true;
                }
                if ($("#city").val() == "") {
                    $(".city").html("Please enter city.");
                    hasError = true;
                }
                if ($("#role").val() == "") {
                    $(".role").html("Please enter role.");
                    hasError = true;
                }
                if (!user_id && files.length == 0) {
                    $(".profile").html("Please enter profile photo.");
                    hasError = true;
                }
                if ($("#password").val() == "") {
                    $(".password").html("Please enter password.");
                    hasError = true;
                }
                if ($("#confirm_password").val() == "") {
                    $(".confirm_password").html("Please enter confirm password.");
                    hasError = true;
                }
                if ($("#post_code").val() == "") {
                    $(".post_code").html("Please enter post code.");
                    hasError = true;
                }
                if (selectedHobby.length == 0) {
                    $(".hobby").html("Please choose hobby.");
                    hasError = true;
                }
                if (!radio) {
                    $(".gender").html("Please choose gender.");
                    hasError = true;
                }
                if ($("#password").val() !== $("#confirm_password").val()) {
                    $(".confirm_password").html("Passwords do not match.");
                    hasError = true;
                }

                if (hasError) {
                    return; 
                }

                let formData = new FormData();
                formData.append('first_name', $('#first_name').val());
                formData.append('last_name', $('#last_name').val());
                formData.append('email', $('#email').val());
                formData.append('contact_no', $('#contact_no').val());
                formData.append('state_id', $('#state').val());
                formData.append('city_id', $('#city').val());
                formData.append('role_id', $('#role').val());

                for (var i = 0; i < files.length; i++) {
                    formData.append('profile[]', files[i]);
                }

                formData.append('password', $('#password').val());
                formData.append('confirm_password', $('#confirm_password').val());
                formData.append('post_code', $('#post_code').val());
                formData.append('hobby', selectedHobby);
                formData.append('gender', radio.value);
                $('#loader').css('display', 'flex');
                
                var url = "{{ route('admin.user.update', ['user_id']) }}";
                
                if (user_id) {
                    formData.append('id', user_id);
                    url = url.replace('user_id', user_id);
                } else {
                    url = "{{ route('admin.user.store') }}"; // Fallback for creating a new user
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
                            toastr.success('User added successfully.');
                            window.location.href = "{{ route('admin.user.index') }}";
                        }
                    },
                    error: function (xhr) {
                        $('#loader').css('display', 'none');
                        var errors = xhr.responseJSON.errors;
                        console.log("errors", errors);

                        if (errors.first_name) {
                            $(".first_name").html(errors.first_name[0]);
                        }
                        if (errors.last_name) {
                            $(".last_name").html(errors.last_name[0]);
                        }
                        if (errors.email) {
                            $(".email").html(errors.email[0]);
                        }
                        if (errors.contact_no) {
                            $(".contact_no").html(errors.contact_no[0]);
                        }
                        if (errors.state) {
                            $(".state").html(errors.state[0]);
                        }
                        if (errors.city) {
                            $(".city").html(errors.city[0]);
                        }
                        if (errors.role) {
                            $(".role").html(errors.role[0]);
                        }
                        if (errors.profile) {
                            $(".profile").html(errors.profile[0]);
                        }
                        if (errors.password) {
                            $(".password").html(errors.password[0]);
                        }
                        if (errors.confirm_password) {
                            $(".confirm_password").html(errors.confirm_password[0]);
                        }
                        if (errors.post_code) {
                            $(".post_code").html(errors.post_code[0]);
                        }
                        if (errors.hobby) {
                            $(".hobby").html(errors.hobby[0]);
                        }
                        if (errors.gender) {
                            $(".gender").html(errors.gender[0]);
                        }
                    }
                });
            });  
            $(".findCity").on("input", function() {
                getCity($("#state").val())
            });
            $(".findState").on("input", function() {
                getState()
            });
            function getState(){

                let state_name = $(".findState").val()
                console.log("state_name",state_name);
                
                var url = "{{ route('search-state') }}";
                url = url+'?search=' + encodeURIComponent(state_name);
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(response) {  
                        let stateData = []
                        response.data.forEach(element => { 
                            stateData+= `<option value=${element.id}>${element.name}</option>`
                        }); 
                        if(response.data.length == 0){
                            stateData+= `<option value="">State not found.</option>`
                        }
                        $("#state").html(stateData) 
                        $('#loader').css('display', 'none');
                    }
                }); 
            }
            function getCity(state_id){ 
                // let state_id = $("#state").val()  
                $('#loader').css('display', 'flex');
                let city_name = $(".findCity").val()
                var url = "{{ route('get-city',['state_id']) }}";
                url = url.replace('state_id',state_id);
                url = url+'?search=' + encodeURIComponent(city_name);
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(response) {  
                        let cities = []
                        response.data.forEach(element => { 
                            cities+= `<option value=${element.id}>${element.name}</option>`
                        }); 
                        if(response.data.length == 0){
                            cities+= `<option value="">City not found.</option>`
                        }
                        $("#state").val(state_id)
                        $('#city').html(cities);
                        $('#loader').css('display', 'none');
                    }
                }); 
            }
        })
    </script>
@endpush
