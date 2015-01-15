@extends('admin.layout.page')

	@section('title')
	    @if (!empty($record))
			{{ $record->title }}
		@else				
			Add New Post
		@endif
	@stop

	@section('page-content')

		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li>
						<a href="{{ url('admin/dashboard') }}">Home</a>
					</li>
					<li>
						<a href="{{ url('/admin/content/posts') }}">Manage Posts</a>
					</li>

					<li class="active">

						@if (!empty($record))
							<strong>{{ $record->title }}</strong>	
						@else				
							<strong>Add New Post</strong>
						@endif
					</li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<span class="size-h2">Manage Blog Posts</span>
			</div>
			<div class="col-md-6 text-right">
				<a href="{{ url('/admin/content/posts') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back to Posts</a>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12"><hr /></div>
		</div>

		<div class="wrapper wrapper-content">
			
			<div class="row">

				<div class="col-lg-12">

									 
					<form method="post" class="form-horizontal">

						{{ Form::hidden('id') }}

						<div class="form-group">
							<label class="col-md-2 control-label">Title</label>
							<div class="col-md-4">{{ Form::text('title', null, ['class' => 'form-control ' . (empty($record) ? 'generate-slug' : ''), 'placeholder' => 'Title', 'data-target' => '.page-slug']) }}</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<label class="col-md-2 control-label">Slug</label>
							<div class="col-md-4">{{ Form::text('slug', null, ['class' => 'form-control page-slug', 'placeholder' => 'Slug']) }}</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<label class="col-md-2 control-label">Date</label>
							<div class="col-md-2">
								<div class="input-group date">
	                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>{{ Form::text('date', null, ['class' => 'form-control', 'placeholder' => 'Date']) }}
	                            </div>
							</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<label class="col-md-2 control-label">Content</label>
							<div class="col-md-10">{{ Form::html('content', null, ['class' => 'form-control summernote', 'placeholder' => 'Content']) }}</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<label class="col-md-2 control-label">Published</label>
							<div class="col-md-4">

								<div class="btn-group js-dropdown-select">
									{{ Form::dropdown('published', \Page::$published, 0 ) }}
								</div>

							</div>
						</div>

						<div class="hr-line-dashed"></div>		

						<div class="form-group">
							<div class="col-md-10 col-sm-offset-2 text-right">
								<a href="{{ url('/admin/content/posts') }}" class="btn btn-default close-button">Cancel</a>
								<button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Save changes</button>
							</div>
						</div>
					
					</form>

				</div>
			</div>
			
		</div>

	@stop

@stop