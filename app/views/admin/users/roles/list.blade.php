@extends('admin.layout.page')
	
	@section('title')
	    Manage Roles &amp; Permissions
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
						<strong>Manage Roles &amp; Permissions</strong>
					</li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<span class="size-h2">User Management</span>
			</div>
			<div class="col-md-6 text-right">

			</div>
		</div>

		<div class="row">
			<div class="col-md-12"><hr /></div>
		</div>

		<div class="wrapper wrapper-content">
			
			<div class="row">
		
				<div class="col-lg-3">
						
					 <table class="table">

						<thead>
							<tr>
								<th>
									Available Roles									
								</th>
							</tr>
						</thead>
						<tbody>

							@foreach ($roles as $record)
								
								<tr>
									<td class="table-nav-link {{ $role->id == $record->id ? 'active' : '' }}">
										<a href="{{url("/admin/users/roles/$record->id")}}">
											<p>
											<span class="dropcap-square grey"><i class="fa fa-lock"></i></span>

											<span>
												<b>{{ $record->name }}</b><br />
												{{ $record->description }}
											</span>
											</p>
										</a>
									</td>
								</tr>

							@endforeach
						</tbody>

					</table>

				</div>

				<div class="col-lg-9">
					
					<table class="table">

						@foreach(Access::allSections() as $section)
							
							<thead>
								<tr>
									<th width="40%">
										{{ $section->title }}										
									</th>
									<th></th>
								</tr>
							</thead>
							<tbody>

								@foreach (Access::allPermissions($section) as $id => $permission)
									
									<tr>
										<td>{{ $permission->title }}</td>
										<td>
											<input type="checkbox" class="i-checks disabled js-post-checkbox" data-url="{{ url("/admin/users/roles/update/$role->id") }}" data-record-id="{{ $id }}" {{ $role->hasPermission($id) ? 'checked' : '' }} {{ ! $role->updatable ? "disabled" : "" }}>
										</td>
									</tr>

								@endforeach
							</tbody>

						@endforeach

					</table>

				</div>
			</div>

		</div>

	@stop

@stop