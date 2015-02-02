
@foreach ($questions as $question)

	<div class="survey-row">
		<div class="container">
			<table>
				<tr>
					<td>
						<span class="circle-number fa-stack fa-lg">
							<i class="fa fa-circle fa-stack-2x"></i>
							<span class="fa color">{{ $question->num }}</span>
						</span>
					</td>
					<td>{{ $question->question }}</td>
					<td>
						
						<span class="circle-selector fa-stack fa-lg">
							<span class="connector first"></span>
							<i class="fa fa-circle fa-stack-2x bg"></i>
							<i class="fa fa-circle fa-stack-2x border"></i>
							<div class="fa fa-circle selector" data-url="{{ url('api.survey.save') }}" data-value="1" data-question-id="{{ $question->id }}"></div>
						</span>
						<br />
						strongly agree
					</td>
					<td>
						<span class="circle-selector fa-stack fa-lg">
							<span class="connector"></span>
							<i class="fa fa-circle fa-stack-2x bg"></i>
							<i class="fa fa-circle fa-stack-2x border"></i>
							<div class="fa fa-circle selector" data-url="{{ url('api.survey.save') }}" data-value="2" data-question-id="{{ $question->id }}"></div>
						</span>
						<br />
						agree
					</td>
					<td>
						<span class="circle-selector fa-stack fa-lg" style="position: relative;">
							<span class="connector"></span>
							<i class="fa fa-circle fa-stack-2x bg"></i>
							<i class="fa fa-circle fa-stack-2x border"></i>
							<div class="fa fa-circle selector" data-url="{{ url('api.survey.save') }}" data-value="3" data-question-id="{{ $question->id }}"></div>
						</span>
						<br />
						not sure
					</td>
					<td>
						<span class="circle-selector fa-stack fa-lg">
							<span class="connector"></span>
						  	<i class="fa fa-circle fa-stack-2x bg"></i>
						  	<i class="fa fa-circle fa-stack-2x border"></i>
						  	<div class="fa fa-circle selector" data-url="{{ url('api.survey.save') }}" data-value="4" data-question-id="{{ $question->id }}"></div>
						</span>
						<br />
						disagree
					</td>
					<td>
						<span class="circle-selector fa-stack fa-lg">
							<span class="connector last"></span>
						  	<i class="fa fa-circle fa-stack-2x bg"></i>
						  	<i class="fa fa-circle fa-stack-2x border"></i>
						  	<div class="fa fa-circle selector" data-url="{{ url('api.survey.save') }}" data-value="5" data-question-id="{{ $question->id }}"></div>
						</span>
						<br />
						strongly disagree
					</td>
				</tr>
			</table>
		</div>
	</div>
@endforeach