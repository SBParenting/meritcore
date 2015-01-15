@extends('admin.layout.page')
	
	@section('title')
	   Add New Images
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

									 
					<form class="dropzone" action="{{ url('/admin/content/images/add') }}" enctype="multipart/form-data"  id="my-images-dropzone">
                        <div class="dropzone-previews"></div>
                    </form>

                    <div class="hr-line-dashed"></div>		

					<div class="form-group">
						<div class="col-md-10 col-sm-offset-2 text-right">
							<a href="{{ url('/admin/content/images') }}" class="btn btn-default close-button">Done</a>
							<button type="submit" class="btn btn-primary js-post-uploads"><i class="fa fa-upload"></i> Upload Images</button>
						</div>
					</div>

				</div>
			</div>
			
		</div>

	@stop

@stop