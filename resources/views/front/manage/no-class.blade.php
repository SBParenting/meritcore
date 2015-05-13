@extends('common.layout.front')

	@section('title')
		Classes
	@stop

	@section('content')

		<div class="page-manage">

			@include('front.manage.partials.header')

			<div class="container" style="margin-top:20%">
				<div class="col-md-12 class-panel closable-panel open">
					<div class="panel-group class-panel no-margin">
						<div class="panel panel-default">
							<span class="btn btn-block btn-line-default giant show-panel" style="white-space: normal;overflow: auto;">No classes were assigned yet. Please, come back later and check if your class is already prepared.</span>
						</div>
					</div>
				</div>
			</div>

		</div>

	@stop

@stop