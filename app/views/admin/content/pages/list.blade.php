@extends('admin.layout.page')
	
	@section('title')
	    Manage Pages
	@stop
	
	@section('page-content')


		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li>
						<a href="{{ url('admin/dashboard') }}">Home</a>
					</li>
					<li class="active">
						<strong>Manage Pages</strong>
					</li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<span class="size-h2">Manage Content Pages</span>
			</div>
			<div class="col-md-6 text-right">
				<div class="btn-group js-show-on-select" style="margin-right: 20px;">
                    <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">Bulk Actions <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/admin/content/pages/bulk') }}?published=1" class="js-post-bulk">Publish</a></li>
                        <li><a href="{{ url('/admin/content/pages/bulk') }}?published=0" class="js-post-bulk">Unpublish</a></li>
                        <li><a href="{{ url('/admin/content/pages/remove/bulk') }}" class="js-post-bulk">Delete</a></li>
                    </ul>
                </div>

                <a href="{{ url('/admin/content/pages/add') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Page</a>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12"><hr /></div>
		</div>

		<div class="wrapper wrapper-content">

			<div class="row">

				<div class="col-lg-12 text-right">
					<div class="btn-group">
                        <a href="{{ url('/admin/content/pages') }}" class="btn btn-sm btn-default {{ $published == "" ? 'active' : '' }}">All Pages</a>
                        <a href="{{ url('/admin/content/pages') }}?published=true" class="btn btn-sm btn-default {{ $published == "true" ? 'active' : '' }}">Published</a>
                        <a href="{{ url('/admin/content/pages') }}?published=false" class="btn btn-sm btn-default {{ $published == "false" ? 'active' : '' }}">Unpublished</a>
                    </div>

                    <div class="hr-line-dashed"></div>
				</div>
			</div>
			
			<div class="row">

				<div class="col-lg-12">
									 
					<table class="table table-striped">
						<thead>
							<tr>
								<th width="50">
									<input type="checkbox" class="i-checks js-select-all">
								</th>
								<th class="sortable" data-field="title">Title</th>
								<th class="sortable" data-field="slug">Slug</th>
								<th width="150" class="sortable" data-field="published">Published</th>
								<th width="150">Actions</th>
							</tr>
						</thead>
						<tbody>
							
							@foreach($records as $record)

								<tr id="record-{{ $record->id }}">
									<td>
										<input type="checkbox" class="i-checks js-select" data-record-id="{{ $record->id }}">
									</td>
									<td><a href="{{ url("/admin/content/pages/update/$record->id") }}">{{ $record->title }}</a></td>
									<td><a href="{{ url("/$record->slug") }}" target="_blank">{{ $record->slug }}</a></td>
									<td>
										@if ($record->published)
											
											<span class="label label-success">{{ \Page::$published[$record->published] }}</span></td>
										@else

											<span class="label label-default">{{ \Page::$published[$record->published] }}</span></td>
										@endif
									</td>
									<td>
										@if (!$record->published)
											<a href="{{ url("/admin/content/pages/publish/$record->id") }}" class="btn btn-xs btn-success do-tooltip js-post" title="Publish this page."><i class="fa fa-bullhorn"></i></a>
										@else
											<a href="{{ url("/admin/content/pages/unpublish/$record->id") }}" class="btn btn-xs btn-default do-tooltip js-post" title="Unpublish this page."><i class="fa fa-bullhorn"></i></a>
										@endif
										<a href="{{ url("/admin/content/pages/update/$record->id") }}" class="btn btn-xs btn-default do-tooltip" title="Update this page."><i class="fa fa-edit"></i></a>
										<a href="{{ url("/admin/content/pages/remove/$record->id") }}" class="btn btn-xs btn-default do-tooltip js-post-remove" title="Remove this page." data-remove="#record-{{ $record->id }}"><i class="fa fa-times"></i></a>
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