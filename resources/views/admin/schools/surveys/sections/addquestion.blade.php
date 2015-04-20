@extends('admin.layout.page')
	@section('title')
	   @if (!empty($record->question))
			{{ $record->question }}
		@else
			Add Question
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
						<a href="{{ url('admin/s/surveys/') }}">Manage Survey</a>
					</li>
					<li>
						<a href="{{ url("admin/s/surveys/questions/$record->survey_id") }}">{{ $record->title }}</a>
					</li>
					<li class="active">
						<strong>Add Question</strong>
					</li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">

			</div>
			<div class="col-md-6 text-right">
				<a href="{{ url("/admin/s/surveys/questions/$record->survey_id") }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back to Questions</a>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12"><hr /></div>
		</div>

		{!! Form::open(['class' => 'form-horizontal']) !!}

		<div class="wrapper wrapper-content animated">

			<div class="row">
				<div class="col-md-6">
					<span class="size-h4">Question Information</span>
				</div>
			</div>

			<div class="row">

				<div class="col-lg-12">

						<div class="hr-line-dashed"></div>

						{!! Form::hidden('id') !!}

						<div class="form-group">
							<label class="col-md-2 control-label">Question</label>
							<div class="col-md-4">
								{!! Form::text('question',(isset($record))?$record->question:null, ['class' => 'form-control', 'placeholder' => 'Survey Title']) !!}
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label">Choose A Competency</label>
							<div class="col-md-4">
								{!! Form::select('competency', App\Models\SurveyGrouping::getTitle(), (isset($record))?$record->competency:null, ['class' => 'form-control', 'id' => 'competency']) !!}
							</div>
						</div>

						<div class="form-group other">
							<label class="col-md-2 control-label">Other</label>
							<div class="col-md-4">
								{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Other Competency']) !!}
							</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<div class="col-md-10 col-sm-offset-2 text-right">
								@if (!empty($record))
									<a href="{{ url("/admin/s/surveys/info/$record->id") }}" class="btn btn-default btn-lg close-button">Cancel</a>
								@else
									<a href="{{ url('/admin/s/surveys') }}" class="btn btn-default btn-lg close-button">Cancel</a>
								@endif
								<button class="btn btn-primary btn-lg" type="submit"><i class="fa fa-check"></i> Save changes</button>
							</div>
						</div>

				</div>

			</div>


			<div class="row">
				<div class="col-md-12"><hr /></div>
			</div>


		</div>

		{!! Form::close() !!}

		@section('script')
		<script type="text/javascript">
			$(document).ready(function(){
				$('.other').hide();
			});
			$('#competency').change(function(){
				var value =  $(this).val();
				if(value == 'Other')
				{
					$('.other').show();
				}
				else
				{
					$('.other').hide();
				}
			});
		</script>

	@stop


	@stop

@stop