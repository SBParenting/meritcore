@extends('admin.layout.page')
	
	@section('title')
	   {{ $record->title }}
	@stop
	
	@section('page-content')

		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li>
						<a href="{{ url('admin/dashboard') }}">Home</a>
					</li>
					<li>
						<a href="{{ url('/admin/content/images') }}">Manage Images</a>
					</li>

					<li class="active">

						@if (!empty($record))
							<strong>{{ $record->title }}</strong>	
						@else				
							<strong>Add New Image</strong>
						@endif
					</li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<span class="size-h2">Manage Content Images</span>
			</div>
			<div class="col-md-6 text-right">
				<a href="{{ url('/admin/content/images') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back to Images</a>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12"><hr /></div>
		</div>

		<div class="wrapper wrapper-content animated">
			
			<div class="row">

				<div class="col-lg-12">

									 
					<form method="post" class="form-horizontal" enctype="multipart/form-data">

						{{ Form::hidden('id') }}

						<div class="form-group">
							<label class="col-md-2 control-label">Title</label>
							<div class="col-md-4">{{ Form::text('title', null, ['class' => 'form-control ' . (empty($record) ? 'generate-slug' : ''), 'placeholder' => 'Title', 'data-target' => '.page-slug']) }}</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label">Image</label>
							<div class="col-md-6">																	
								<img src="{{ url($record->path) }}" alt="{{ $record->title }}" style="width: 100%">
								<div class="hr-line-dashed"></div>
								<a href="#" class="btn btn-default fileinput-button">
									<i class="fa fa-upload"></i> 
									<span class="display-text">Upload New Image</span>
									{{ Form::file('file') }}
								</a>

								<a href="{{ url("/admin/content/images/remove/$record->id") }}" class="btn btn-danger do-tooltip js-post-remove" title="Remove this page." data-remove="#record-{{ $record->id }}"><i class="fa fa-times"></i> Delete Image Record</a>
							</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<div class="col-md-10 col-sm-offset-2 text-right">
								<a href="{{ url('/admin/content/images') }}" class="btn btn-default close-button">Cancel</a>
								<button type="submit" class="btn btn-primary js-post-upload"><i class="fa fa-check"></i> Save changes</button>
							</div>
						</div>

				
					</form>

				</div>
			</div>
			
		</div>

	@stop

@stop