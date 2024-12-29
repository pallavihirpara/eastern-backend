@extends('admin.layouts.master')
@section('title', 'Change Password')

@section('breadcrumb-title')
    <h1>Change Password</h1>
@stop
@section('breadcrumb-items')
    <li class="breadcrumb-item" aria-current="page"><a href="javascript:void(0);" class="show-item">{{ __('Change Password')}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Add')}}</li>
@stop
@section('content')
    @include('admin.components.breadcrumb')
      <div class="container-fluid">
        <div class="row">
          <!-- right column -->
          <div class="col-md-6">
            <!-- general form elements disabled -->
            <div class="card card-primary">
              <!-- /.card-header -->
              <div class="card-body">
                <form class="forms-sample" action="{{ route('admin.change_pass.store') }}" method="POST" autocomplete="off">
                    @csrf
                  <div class="row">
                        <!-- text input -->
                        <div class="form-group col-md-12">
                            <label for="first_name">{{ __('Old Password')}}</label>
                            <input type="password" class="form-control" name="old_password" placeholder="Enter Your Old Password" value="{{old('old_password')}}">
                            <span class="text-danger">{{$errors->first('old_password')}}</span>
                        </div>
                        <!-- text input -->
                        <div class="form-group col-md-12">
                            <label for="last_name">{{ __('New Password')}}</label>
                            <input type="password" class="form-control" name="new_password" placeholder="Enter Your Confirm Password" value="{{old('new_password')}}">
                            <span class="text-danger">{{$errors->first('new_password')}}</span>
                        </div>
                      <!-- text input -->
                        <div class="form-group col-md-12">
                        <label for="email_address">{{ __('Confirm Password')}}</label>
                        <input type="password" class="form-control" name="con_password" placeholder="Enter Your Confirm Password" value="{{old('con_password')}}">
                        <span class="text-danger">{{$errors->first('con_password')}}</span>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary add-item mr-2">{{ __('Save')}}</button>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
           </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
@endsection
