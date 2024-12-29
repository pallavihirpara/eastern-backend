@extends('admin.layouts.master')
@section('title', 'Dashboard')
@section('breadcrumb-title')
<h1>Dashboard</h1>
@stop

@section('breadcrumb-items')
<li class="breadcrumb-item active" aria-current="page">{{ __('Dashboard')}}</li>
@stop

@section('content')
@include('admin.components.breadcrumb')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <h5 class="mb-2">Home Menu</h5>
        <div class="row">   
            <div class="col-md-3 col-sm-12 col-12">
                <a href="{{route('admin.user.index')}}">
                    <div class="info-box">
                        <span class="info-box-icon bg-secondary"><i class="fa fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text text-dark">Total Users</span>
                            <span class="info-box-number text-dark">{{ $users }}</span>
                        </div>
                    </div>
                </a>
            </div>
        </div> 
    </div>
</section>

@endsection
