
<script type="text/template" id="questionMobileTemplate">

<div class="survey-row-mobile question-row-(data:num)">
		<div class="container">
			<table class="content">
				<tr>
					<td>
						<span class="circle-number">
							<i class="icon-circle fa-stack-2x"></i>
							<span class="fa color">(data:question_num)</span>
						</span>
					</td>
					<td>(data:title)</td>
				</tr>
			</table>
			<table class="indicators">
				<tr>
					<td class="indicator-question-(data:num)-1">
						<span class="circle-selector">
							<span class="connector first"></span>
							<i class="icon-circle bg"></i>
							<i class="icon-circle border"></i>
							<i class="icon-circle selector" data-url="{{ url("api/survey/$key/saveInfo") }}" data-value="1" data-question-id="(data:num)" data-indicator=".indicator-question-(data:num)-1" data-question-row=".question-row-(data:num)"></i>
						</span>
						<br />
						yes
					</td>
					<td class="indicator-question-(data:id)-2">
						<span class="circle-selector">
							<span class="connector last"></span>
						  	<i class="icon-circle bg"></i>
						  	<i class="icon-circle border"></i>
						  	<i class="icon-circle selector" data-url="{{ url("api/survey/$key/savePost") }}" data-value="2" data-question-id="(data:question_num)" data-indicator=".indicator-question-(data:question_num)-2" data-question-row=".question-row-(data:question_num)"></i>
						</span>
						<br/>
						no
					</td>
				</tr>
			</table>
		</div>
	</div>

</script>
