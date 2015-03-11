
<script type="text/template" id="questionMobileTemplate">

<div class="survey-row-mobile question-row-(data:id)">
		<div class="container">
			<table class="content">
				<tr>
					<td>
						<span class="circle-number">
							<i class="icon-circle fa-stack-2x"></i>
							<span class="fa color">(data:num)</span>
						</span>
					</td>
					<td>(data:question)</td>
				</tr>
			</table>
			<table class="indicators">
				<tr>
					<td class="indicator-question-(data:id)-1">
						<span class="circle-selector">
							<span class="connector first"></span>
							<i class="icon-circle bg"></i>
							<i class="icon-circle border"></i>
							<i class="icon-circle selector" data-url="{{ url("api/survey/$key/save") }}" data-value="1" data-question-id="(data:id)" data-indicator=".indicator-question-(data:id)-1" data-question-row=".question-row-(data:id)"></i>
						</span>
						<br />
						strongly agree
					</td>
					<td class="indicator-question-(data:id)-2">
						<span class="circle-selector">
							<span class="connector"></span>
							<i class="icon-circle bg"></i>
							<i class="icon-circle border"></i>
							<i class="icon-circle selector" data-url="{{ url("api/survey/$key/save") }}" data-value="2" data-question-id="(data:id)" data-indicator=".indicator-question-(data:id)-2" data-question-row=".question-row-(data:id)"></i>
						</span>
						<br />
						agree
					</td>
					<td class="indicator-question-(data:id)-3">
						<span class="circle-selector">
							<span class="connector"></span>
							<i class="icon-circle bg"></i>
							<i class="icon-circle border"></i>
							<i class="icon-circle selector" data-url="{{ url("api/survey/$key/save") }}" data-value="3" data-question-id="(data:id)" data-indicator=".indicator-question-(data:id)-3" data-question-row=".question-row-(data:id)"></i>
						</span>
						<br />
						not sure
					</td>
					<td class="indicator-question-(data:id)-4">
						<span class="circle-selector">
							<span class="connector"></span>
						  	<i class="icon-circle bg"></i>
						  	<i class="icon-circle border"></i>
						  	<i class="icon-circle selector" data-url="{{ url("api/survey/$key/save") }}" data-value="4" data-question-id="(data:id)" data-indicator=".indicator-question-(data:id)-4" data-question-row=".question-row-(data:id)"></i>
						</span>
						<br />
						disagree
					</td>
					<td class="indicator-question-(data:id)-5">
						<span class="circle-selector">
							<span class="connector last"></span>
						  	<i class="icon-circle bg"></i>
						  	<i class="icon-circle border"></i>
						  	<i class="icon-circle selector" data-url="{{ url("api/survey/$key/save") }}" data-value="5" data-question-id="(data:id)" data-indicator=".indicator-question-(data:id)-5" data-question-row=".question-row-(data:id)"></i>
						</span>
						<br />
						strongly disagree
					</td>
				</tr>
			</table>
		</div>
	</div>

</script>