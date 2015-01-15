@extends('admin.layout.page')
	
	@section('title')
	    Manage Files					
	@stop

	@section('page-content')

		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li>
						<a href="{{ url('admin/dashboard') }}">Home</a>
					</li>
					<li class="active">
						<strong>Manage Files</strong>
					</li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<span class="size-h2">Manage Content Files</span>
			</div>
			<div class="col-md-6 text-right">
				<div class="btn-group js-show-on-select" style="margin-right: 20px;">
                    <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">Bulk Actions <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/admin/content/files/remove/bulk') }}" class="js-post-bulk">Delete</a></li>
                    </ul>
                </div>

                <a href="{{ url('/admin/content/files/add') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add File</a>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12"><hr /></div>
		</div>

		<div class="wrapper wrapper-content">
			
			<div class="row">

				<div class="col-lg-12">
									 
					<table class="table table-striped">
						<thead>
							<tr>
								<th width="50">
									<input type="checkbox" class="i-checks js-select-all">
								</th>
								<th class="sortable" data-field="title">Title</th>
								<th class="sortable" data-field="path">Path</th>
								<th width="150">Actions</th>
							</tr>
						</thead>
						<tbody>
							
							@foreach($records as $record)

								<tr id="record-{{ $record->id }}">
									<td>
										<input type="checkbox" class="i-checks js-select" data-record-id="{{ $record->id }}">
									</td>
									<td><a href="{{ url("/admin/content/files/update/$record->id") }}">{{ $record->title }}</a></td>
									<td><a href="{{ url($record->path) }}" target="_blank">{{ $record->path }}</a></td>
									<td>
										<a href="{{ url("/admin/content/files/update/$record->id") }}" class="btn btn-xs btn-default do-tooltip" title="Update this files."><i class="fa fa-edit"></i></a>
										<a href="{{ url("/admin/content/files/remove/$record->id") }}" class="btn btn-xs btn-default do-tooltip js-post-remove" title="Remove this files." data-remove="#record-{{ $record->id }}"><i class="fa fa-times"></i></a>
									</td>
								</tr>
								
							@endforeach

							@if (count($records) == 0)

								<tr>
									<td colspan="5"><em>There is nothing to show here at the moment...</em></td>
								</tr>

							@endif

						</tbody>
					</table>

				</div>
			</div>

			<div class="row">

				<div class="col-lg-12 text-right">
					
					{{ $records->links() }}

				</div>

			</div>
			
		</div>

	@stop

@stop