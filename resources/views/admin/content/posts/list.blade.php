@extends('admin.layout.page')
	
	@section('title')
	    Manage Posts
	@stop

	@section('page-content')

		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li>
						<a href="{{ url('admin/dashboard') }}">Home</a>
					</li>
					<li class="active">
						<strong>Manage Posts</strong>
					</li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<span class="size-h2">Manage Blog Posts</span>
			</div>
			<div class="col-md-6 text-right">
				<div class="btn-group js-show-on-select" style="margin-right: 20px;">
                    <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">Bulk Actions <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/admin/content/posts/bulk') }}?published=1" class="js-post-bulk">Publish</a></li>
                        <li><a href="{{ url('/admin/content/posts/bulk') }}?published=0" class="js-post-bulk">Unpublish</a></li>
                        <li><a href="{{ url('/admin/content/posts/remove/bulk') }}" class="js-post-bulk">Delete</a></li>
                    </ul>
                </div>

                <a href="{{ url('/admin/content/posts/add') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Post</a>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12"><hr /></div>
		</div>

		<div class="wrapper wrapper-content">

			<div class="row">

				<div class="col-lg-12 text-right">
					<div class="btn-group">
                        <a href="{{ url('/admin/content/posts') }}" class="btn btn-sm btn-default {{ $published == "" ? 'active' : '' }}">All Posts</a>
                        <a href="{{ url('/admin/content/posts') }}?published=true" class="btn btn-sm btn-default {{ $published == "true" ? 'active' : '' }}">Published</a>
                        <a href="{{ url('/admin/content/posts') }}?published=false" class="btn btn-sm btn-default {{ $published == "false" ? 'active' : '' }}">Unpublished</a>
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
								<th class="sortable" data-field="date">Date</th>
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
									<td><a href="{{ url("/admin/content/posts/update/$record->id") }}">{{ $record->title }}</a></td>
									<td><a href="{{ url("/$record->slug") }}" target="_blank">{{ $record->slug }}</a></td>
									<td>{{ $record->date }}</td>
									<td>
										@if ($record->published)
											
											<span class="label label-primary">{{ \Post::$published[$record->published] }}</span></td>
										@else

											<span class="label label-default">{{ \Post::$published[$record->published] }}</span></td>
										@endif
									</td>
									<td>
										@if (!$record->published)
											<a href="{{ url("/admin/content/posts/publish/$record->id") }}" class="btn btn-xs btn-primary do-tooltip js-post" title="Publish this post."><i class="fa fa-bullhorn"></i></a>
										@else
											<a href="{{ url("/admin/content/posts/unpublish/$record->id") }}" class="btn btn-xs btn-default do-tooltip js-post" title="Unpublish this post."><i class="fa fa-bullhorn"></i></a>
										@endif
										<a href="{{ url("/admin/content/posts/update/$record->id") }}" class="btn btn-xs btn-default do-tooltip" title="Update this post."><i class="fa fa-edit"></i></a>
										<a href="{{ url("/admin/content/posts/remove/$record->id") }}" class="btn btn-xs btn-default do-tooltip js-post-remove" title="Remove this post." data-remove="#record-{{ $record->id }}"><i class="fa fa-times"></i></a>
									</td>
								</tr>
								
							@endforeach

							@if (count($records) == 0)

								<tr>
									<td colspan="8"><em>There is nothing to show here at the moment...</em></td>
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