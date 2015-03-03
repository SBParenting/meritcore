@extends('front.survey.layout')

@section('content')

<div class="container-page">

	<div class="wrapper">
		<div class="survey-block survey-header">
			<a href="{{URL::to('children/select')}}" class="logo"><img src="{{ url('public/front/img/sbp-logo.png') }}" /></a>
			<div class="container">
				<a href="#" id="showPage" class="header-link"><i class="icon-help"></i> help</a>
				<a href="#" id="showMenu" class="header-link"><i class="icon-menu"></i> menu</a>
				<a href="#" class="logo"><div class="logo child-thumbnail"></div><p class="child-name">Child name</p></a>
				@if(isset($model))
                    <h1>UPDATE CHILD</h1>
                @else
                    <h1>ADD CHILD</h1>
                @endif
            </div>
		</div>

		<div class="survey-block general-content page-signup">
			<div class="form-inner add-child-form">
				<div class="signup-body"></div>
				<div class="container register-form child-form">
					<div class="form-container show-post-success closed">

					</div>

					<div class="form-container hide-post-success" id="register-form-width">
						<div class="form-group form-head-text"><span class="line-thru">Fill in the information to get your child started </span></div>

						<section>

                            @if(isset($model))
                                {{ Form::model($model, ['role' => 'form', 'novalidate', 'autocomplete' => 'Off', 'class' => 'submit-on-enter', 'files' => true]) }}
                            @else
                                {{ Form::open(['role' => 'form', 'novalidate', 'autocomplete' => 'Off', 'class' => 'submit-on-enter', 'files' => true]) }}
                            @endif

                            {{ Form::hidden('user_id',\Auth::id()) }}

							<div class="form-group">
								<div class="input-group input-group-lg">

									<span class="input-group-addon">
										<span class=" glyphicon glyphicon-user"></span>
									</span>
									{{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'First Name*', 'autocomplete' => 'Off']) }}
								</div>
							</div>

							<div class="form-group">
								<div class="input-group input-group-lg">

									<span class="input-group-addon">
										<img src="/public/front/img/cake-icon.png" width="20px" height="20px">
									</span>
									{{ Form::text('birth_date',null,['class' => 'form-control cal-icon','id' => 'cal', 'placeholder'=>'Birth Date*']) }}
								</div>
							</div>

							<div class="radio-buttons">
								<dl class="dl-horizontal" data-name="sex">
									<dd>
										<label class="ui-radio2">

                                            {{ Form::radio('sex','female') }}
											<span ><label style="padding-left: 7px;">OR</label></span>
										</label>

										<label class="ui-radio">
											{{ Form::radio('sex','male') }}
											<span></span>
										</label>
                                        <span class="error">x</span>
										<span id="calculate-age">?</span><span class="text">years old</span>
									</dd>
								</dl>

							</div>
							<div class="form-group">
								<div class="input-group input-group-lg">
									<span class="input-group-addon">
										<span class=" glyphicon glyphicon-lock"></span>
									</span>
									{{ Form::text('student_id', null, ['class' => 'form-control id-input', 'placeholder' => 'Student ID', 'autocomplete' => 'Off']) }}
									<p class="id-text"><a href="#">What is this for?</a></p>
								</div>
							</div>
							<p font-size="14pt;">* Required Fields</p>

                            {{ Form::file('image',['id' => 'image', 'data-image' => isset($model) ? $model->avatar : 'false']) }}

                            {{ Form::hidden('avatar',null,['id'=>'avatar']) }}

							<div class="form-group">
                                @if(isset($model))
								    <button type="submit" class="btn btn-lg btn-block btn-orange">Update Child</button>
                                @else
								    <button type="submit" class="btn btn-lg btn-block btn-orange">Add Child</button>
                                @endif
							</div>


                                {{ Form::close() }}
						</section>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
@stop

@section('css')

{{ HTML::style("public/front/css/main.css") }}
{{ HTML::style("/public/front/css/font.css") }}
{{ HTML::style("/public/front/css/picedit.css") }}

@stop

@section('script')

	<script type="text/javascript">
		$('#cal').datepicker({
			format: 'yyyy-mm-dd'
		}).on('change', function(e) {

			var currentDate = new Date();
			var selectedDate = new Date($(this).val());
			var age = currentDate.getFullYear() - selectedDate.getFullYear();
			var m = currentDate.getMonth() - selectedDate.getMonth();
			if (m < 0 || (m === 0 && currentDate.getDate() < selectedDate.getDate())) {
				age--;
			}
			$('#calculate-age').html(age);
		});

        $('#cal').trigger('change');
	</script>

    {{ HTML::script("public/admin/libs/jquery-form/jquery.form.min.js") }}

    {{ HTML::script("public/front/js/api.js") }}
    {{ HTML::script("public/front/js/app.js") }}
    {{ HTML::script("public/front/js/form.js") }}

    {{ HTML::script("/public/front/js/picedit.js") }}

    <script type="text/javascript">
        $(function(){
            $('#image').picEdit({
                'defaultImage': '/public/uploads/children/squared-'+$('#image').attr('data-image'),
                formSubmitted: function(response) {
                    console.log(response);
                    $.form.showFormResult(JSON.parse(response.response),$('.submit-on-enter'));
                }
            });
            $('.picedit_box').addClass('dropzone');
        });
    </script>



@stop