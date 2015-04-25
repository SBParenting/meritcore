@extends('front.survey.layout')


@section('content')

	<div class="container-page">

		<div class="wrapper">

			@include('front.survey.sections.header')
			{!! Form::open(['class'=>'form-horizontal', 'url' => $key.'/add-info' ]) !!}
			{!! Form::token() !!}

			{!! Form::hidden('secret', $student->secret) !!}
			{!! Form::hidden('student_id', $student->id) !!}
			{!! Form::hidden('campaign_id', $campaign->id) !!}
			<div class="survey-block survey-content hidden-xs" >
				<div class="survey-row">
					<div class="container">
						<table>
							<tr>
								<td>
									<label class="col-md-2 control-label">Teacher's Name</label>
									<div class="col-md-6">{!! Form::text('teacher_name', null, ['class' => 'form-control', 'placeholder' => 'Teacher Name']) !!}</div>
								</td>
							</tr>
							<tr>
								<td>
									<label class="col-md-2 control-label">Heroes ID</label>
									<div class="col-md-4">{!! Form::text('heroes_id', null, ['class' => 'form-control', 'placeholder' => 'Heroes ID']) !!}</div>
								</td>
							</tr>
							<tr>
								<td>
									<label class="col-md-2 control-label">What Classes are you in ?</label>
									<div class="col-md-2">
										{!! Form::select('class',array('A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', 'E' => 'E', 'F' => 'F', 'G' => 'G', 'H' => 'H', 'I' => 'I', 'J' => 'J', 'K' => 'K', 'L' => 'L' ), null, ['class' => 'form-control', 'placeholder' => 'Select Class'], 'btn btn-default' ) !!}
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="survey-row">
					<div class="container">
						<table>
							<tr>
								<td>
									<label class="col-md-2 control-label">Heroes Instructor Name</label>
									<div class="col-md-4">{!! Form::text('instructor_name', null, ['class' => 'form-control', 'placeholder' => 'Heroes Instructor Name']) !!}</div>
								</td>
							</tr>
							<tr>
								<td>
									<label class="col-md-2 control-label">City/Town</label>
									<div class="col-md-6">{!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'City']) !!}</div>
								</td>
							</tr>
							<tr>
								<td>
									<label class="col-md-2 control-label">Grade</label>
									<div class="col-md-2">{!! Form::radio('gender', 'M', true)!!} Male </div>
									<div class="col-md-2">{!! Form::radio('gender', 'F', false) !!} Female </div>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="survey-row">
					<div class="container">
						<table>
							<tr>
								<td>
									<label class="col-md-2 control-label">How old are you ? </label>
									<div class="col-md-2">
										{!! Form::select('age',array('10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17 or Older'), null, ['class' => 'form-control', 'placeholder' => 'Select Class'], 'btn btn-default' ) !!}
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<label class="col-md-2 control-label">What grade are you in ?</label>
									<div class="col-md-2">
										{!! Form::select('grade',array('5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10', '11' => '11', '12' => '12'), null, ['class' => 'form-control', 'placeholder' => 'Select Class'], 'btn btn-default' ) !!}
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>

			<div class="survey-block survey-content visible-xs-block">
				<div id="questionsMobileContainer" class="survey-inner">


				</div>
			</div>

			<div class="survey-block survey-footer">
				<div class="container">
					<a href="#" id="btnSurveyBack" class="pull-left btn btn-primary disabled"><i class="glyphicon glyphicon-arrow-left"></i> BACK</a>
					<a href="#" id="btnSurveyComplete" class="pull-right inline btn btn-warning closed" data-url="{{ url("api/survey/$key/complete") }}"><i class="glyphicon glyphicon-ok"></i> COMPLETE SURVEY</a>
					<button class="btn btn-primary pull-right inline btn btn-warning disabled" id="btnSurveyNext" type="submit"> Next <i class="glyphicon glyphicon-arrow-right"></i></button>
				</div>
			</div>
			{!! Form::close() !!}
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.form-control').change(function(){
				var empty = 0;
				$('.form-control').each(function(){
					if(!$(this).val()){
						empty++;
					}
				});
				if(empty == 0){
					$('#btnSurveyNext').removeClass('disabled');
				}
			});
		});
	</script>

@stop
