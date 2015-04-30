@extends('admin.layout.page')

	@section('title')
	    Manage Users
	@stop

	@section('page-content')

		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li>
						<a href="{{ url('admin/dashboard') }}">Home</a>
					</li>
					<li>
						<a href="{{ url('admin/users') }}">Users</a>
					</li>
					<li class="active">
						<strong>Manage Users</strong>
					</li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<span class="size-h2">User Management</span>
			</div>
			<div class="col-md-6 text-right">
				<div class="btn-group js-show-on-select" style="margin-right: 20px;">
                    <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">Bulk Actions <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                    	<li><a href="{{ url('/admin/users/mail/bulk') }}" class="js-post-bulk">Send Mail</a></li>
                    	<li><a href="{{ url('/admin/users/bulk') }}?status=Active" class="js-post-bulk">Activate</a></li>
                    	<li><a href="{{ url('/admin/users/bulk') }}?status=Deactivated" class="js-post-bulk">Deactivate</a></li>
                        <li><a href="{{ url('/admin/users/remove/bulk') }}" class="js-post-bulk">Delete</a></li>
                    </ul>
                </div>

                <a href="{{ url('/admin/users/add') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add User</a>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12"><hr /></div>
		</div>

		<div class="row">
			<div class="col-md-4">
				{!! Form::open(['class'=>'no-ajax search-box']) !!}
				<div class="input-group">
					{!! Form::text('search',null,['class'=>'form-control']) !!}
					<span class="input-group-btn">
						{!! Form::button('<i class="fa fa-search"></i>',['class'=>'btn btn-default', 'style'=>'padding-bottom:7px', 'type'=>'submit']) !!}
					</span>
				</div>
				{!! Form::close() !!}
			</div>
		</div>

		<div class="row">
			<div class="col-md-12"><hr /></div>
		</div>

		<div class="row">

			<div class="col-lg-12">

				<table class="table table-striped">
					<thead>
						<tr>
							{{--<th>--}}
								{{--<input type="checkbox" class="i-checks js-select-all">--}}
							{{--</th>--}}
							<th class="sortable" data-field="name">Name</th>
							<th class="sortable" data-field="username">Username</th>
							<th class="sortable" data-field="email">Email</th>
							<th class="sortable" data-field="role_id">Role</th>
							<th class="sortable" data-field="last_login">Last Login</th>
							<th class="sortable" data-field="status">Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody id="entries">

						{!! Form::token() !!}

						@foreach($records as $record)

							<tr id="record-{{ $record->id }}">
								{{--<td>--}}
									{{--<input type="checkbox" class="i-checks js-select" data-record-id="{{ $record->id }}">--}}
								{{--</td>--}}
								<td><a href="{{ url("/admin/users/update/$record->id") }}">{{ $record->getName() }}</a></td>
								<td><a href="{{ url("/admin/users/update/$record->id") }}">{{ $record->username }}</a></td>
								<td>{{ $record->email }}</td>
								<td>{{ str($record->role_id) }}</td>
								<td>{{ str(get_date($record->last_login)) }}</td>
								<td>
									@if ($record->status=='Active')

										<span class="label label-success">{{ $record->status }}</span></td>
									@else

										<span class="label label-default">{{ $record->status }}</span></td>
									@endif
								<td>
									<a href="{{ url("/admin/users/mail/$record->id") }}" class="btn btn-xs btn-default do-tooltip js-post" title="Send login info to user."><i class="fa fa-envelope"></i></a>
									<a href="{{ url("/admin/users/update/$record->id") }}" class="btn btn-xs btn-default do-tooltip" title="Update this user."><i class="fa fa-edit"></i></a>
									<a href="{{ url("/admin/users/remove/$record->id") }}" class="btn btn-xs btn-default do-tooltip js-post-remove" title="Remove this user." data-remove="#record-{{ $record->id }}"><i class="fa fa-times"></i></a>
								</td>
							</tr>

						@endforeach

					</tbody>
				</table>

				{!! $records->render() !!}

			</div>

		</div>

	@stop

	@section('script')
		<script type="text/javascript">
			$('.search-box').find('input').on('keyup',function(e){
				if (e.which == 13) {
					$('.search-box').submit();
				}
			});
		</script>
	@stop

@stop