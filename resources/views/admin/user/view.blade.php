@extends('admin.layouts.master')
@section('title', 'View Users')

@section('breadcrumb-title')
<h1>View Users</h1>
<a href="{{ route('admin.user.index') }}" tooltip="Users List" class="badge badge-secondary"><i class="fa fa-arrow-left"></i></a>
<span>{{ __('Back')}}</span>
@stop
@section('breadcrumb-items')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.user.index') }}" class="show-item">{{ __('Users')}}</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ __('Show')}}</li>
@stop
@section('content')
@include('admin.components.breadcrumb')

<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<table id="tech-data-table" class="tech-data-table table table-bordered table-striped">
						<thead>
							<tr>
								<th>Name</th>
								<td>{{ $user->first_name .' '.$user->last_name }}</td>
							</tr>
							<tr>
								<th>Email</th>
								<td>{{ $user->email }}</td>
							</tr>
							<tr>
								<th>Mobile No</th>
								<td>{{ $user->contact_no }}</td>
							</tr>
							<tr>
								<th>State</th>
								<td>{{ $user->state->name }}</td>
							</tr>
							<tr>
								<th>City</th>
								<td>{{ $user->city->name }}</td>
							</tr>
							<tr>
								<th>Profile</th>
								<td>

									@if($user->images)
										@foreach($user->images as $user_image)
										<img src="{{asset('uploads/user/'.$user_image->name)}}" width="50" alt="" srcset="">
										@endforeach
									@else
										<img src="{{ asset('assets/admin/no-img.jpeg') }}" width="100">
									@endif
								</td>
							</tr>
							<tr>
								<th>Role</th>
								<td>
									{{$user->roles[0]->name}}
								</td>
							</tr>  
							<tr>
								<th>Hobby</th>
								<td>
									{{implode(', ',json_decode($user->hobbies))}}
								</td>
							</tr> 
							<tr>
								<th>Gender</th>
								<td>
									{{$user->gender}}
								</td>
							</tr> 
							<tr>
								<th>Post Code</th>
								<td>
									{{$user->post_code}}
								</td>
							</tr> 
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection