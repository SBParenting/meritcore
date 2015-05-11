
<script type="text/template" id="questionTemplate">
	
	<div class="survey-row question-row-(data:num) (data:done=true)">
		<div class="container">
			<table>
				<tr>
					<td>
						<span class="circle-number">
							<i class="icon-circle"></i>
							<span class="color">(data:num)</span>
						</span>
					</td>
					<td>(data:question)</td>
					<td class="indicator-question-(data:num)-1 (data:value=1)">
						<span class="circle-selector">
							<span class="connector first"></span>
							<i class="icon-circle bg"></i>
							<i class="icon-circle border"></i>
							<i class="icon-circle selector" data-url="{{ url("api/survey/$key/saveInfo") }}" data-value="1" data-question-id="(data:num)" data-indicator=".indicator-question-(data:num)-1" data-question-row=".question-row-(data:num)"></i>
						</span>
						yes
					</td>
					<td class="indicator-question-(data:num)-2 (data:value=2)">
						<span class="circle-selector">
							<span class="connector last"></span>
						  	<i class="icon-circle bg"></i>
						  	<i class="icon-circle border"></i>
						  	<i class="icon-circle selector" data-url="{{ url("api/survey/$key/saveInfo") }}" data-value="2" data-question-id="(data:num)" data-indicator=".indicator-question-(data:num)-2" data-question-row=".question-row-(data:num)"></i>
						</span>
						no
					</td>
				</tr>
			</table>
		</div>
	</div>

</script>

<script type="text/template" id="questionHeroesTemplate">

	<div class="survey-row question-row-(data:num) (data:done=true)">
		<div class="container">
			<table>
				<tr>
					<td>
						<span class="circle-number">
							<i class="icon-circle"></i>
							<span class="color">(data:num)</span>
						</span>
					</td>
					<td>(data:question)</td>
					<td class="indicator-question-(data:num)-1 (data:value=1)">
						<span class="circle-selector">
							<span class="connector first"></span>
							<i class="icon-circle bg"></i>
							<i class="icon-circle border"></i>
							<i class="icon-circle selector" data-url="{{ url("api/survey/$key/saveInfo") }}" data-value="1" data-question-id="(data:num)" data-indicator=".indicator-question-(data:num)-1" data-question-row=".question-row-(data:num)"></i>
						</span>
						HEROES®
					</td>
					<td class="indicator-question-(data:num)-2 (data:value=2)">
						<span class="circle-selector">
							<span class="connector last"></span>
						  	<i class="icon-circle bg"></i>
						  	<i class="icon-circle border"></i>
						  	<i class="icon-circle selector" data-url="{{ url("api/survey/$key/saveInfo") }}" data-value="2" data-question-id="(data:num)" data-indicator=".indicator-question-(data:num)-2" data-question-row=".question-row-(data:num)"></i>
						</span>
						HEROES® 2
					</td>
				</tr>
			</table>
		</div>
	</div>

</script>

<script type="text/template" id="questionTeachTemplate">

	<div class="survey-row question-row-(data:num) (data:done=true)">
		<div class="container">
			<table>
				<tr>
					<td>
						<span class="circle-number">
							<i class="icon-circle"></i>
							<span class="color">(data:num)</span>
						</span>
					</td>
					<td>(data:question)</td>
					<td class="indicator-question-(data:num)-1 (data:value=1)">
						<span class="circle-selector">
							<span class="connector first"></span>
							<i class="icon-circle bg"></i>
							<i class="icon-circle border"></i>
							<i class="icon-circle selector" data-url="{{ url("api/survey/$key/saveInfo") }}" data-value="1" data-question-id="(data:num)" data-indicator=".indicator-question-(data:num)-1" data-question-row=".question-row-(data:num)"></i>
						</span>
						A Volunteer
					</td>
					<td class="indicator-question-(data:num)-2 (data:value=2)">
						<span class="circle-selector">
							<span class="connector"></span>
							<i class="icon-circle bg"></i>
							<i class="icon-circle border"></i>
							<i class="icon-circle selector" data-url="{{ url("api/survey/$key/saveInfo") }}" data-value="2" data-question-id="(data:num)" data-indicator=".indicator-question-(data:num)-2" data-question-row=".question-row-(data:num)"></i>
						</span>
						An Instructor
					</td>
					<td class="indicator-question-(data:num)-3 (data:value=3)">
						<span class="circle-selector">
							<span class="connector last"></span>
						  	<i class="icon-circle bg"></i>
						  	<i class="icon-circle border"></i>
						  	<i class="icon-circle selector" data-url="{{ url("api/survey/$key/saveInfo") }}" data-value="3" data-question-id="(data:num)" data-indicator=".indicator-question-(data:num)-3" data-question-row=".question-row-(data:num)"></i>
						</span>
						A Instructor and A Volunteer
					</td>
				</tr>
			</table>
		</div>
	</div>

</script>