@extends('admin.layout.page')
	
	@section('title')
	    Manage Images
	@stop

	@section('page-content')

		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li>
						<a href="{{ url('admin/dashboard') }}">Home</a>
					</li>
					<li class="active">
						<strong>Manage Images</strong>
					</li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<span class="size-h2">Manage Content Images</span>
			</div>
			<div class="col-md-6 text-right">
				<div class="btn-group js-show-on-select" style="margin-right: 20px;">
                    <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">Bulk Actions <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/admin/content/images/remove/bulk') }}" class="js-post-bulk">Delete</a></li>
                    </ul>
                </div>

                <a href="{{ url('/admin/content/images/add') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Images</a>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12"><hr /></div>
		</div>

		<div class="wrapper wrapper-content">

			@if (count($records) != 0)
				<div class="row">
					<div class="col-lg-12">
						<span class="btn btn-default">
							<input type="checkbox" class="i-checks js-select-all"> Select All
						</span>
						<div class="hr-line-dashed"></div>		
					</div>
				</div>
			@endif
			
			<div class="row">

				<div class="col-lg-12">

					@foreach($records as $record)
									 
						<a class="gallery-thumb do-tooltip" href="{{ url('/admin/content/images/update/'.$record->id) }}" title="{{ $record->title }}">
                            <img src="{{ url($record->thumbnail) }}" alt="{{ $record->title }}">
                            <input type="checkbox" class="i-checks js-select" data-record-id="{{ $record->id }}">
                        </a>

                    @endforeach

                    @if (count($records) == 0)

                    	<em>There are no images to show here at the moment...</em>

                    @endif

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