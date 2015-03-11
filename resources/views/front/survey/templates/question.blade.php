
<script type="text/template" id="questionTemplate">
	
	<div class="survey-row question-row-(data:id) (data:done=true)">
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
					<td class="indicator-question-(data:id)-1 (data:value=1)">
						<span class="circle-selector">
							<span class="connector first"></span>
							<i class="icon-circle bg"></i>
							<i class="icon-circle border"></i>
							<i class="icon-circle selector" data-url="{{ url("api/survey/$key/save") }}" data-value="1" data-question-id="(data:id)" data-indicator=".indicator-question-(data:id)-1" data-question-row=".question-row-(data:id)"></i>
						</span>
						strongly agree
					</td>
					<td class="indicator-question-(data:id)-2 (data:value=2)">
						<span class="circle-selector">
							<span class="connector"></span>
							<i class="icon-circle bg"></i>
							<i class="icon-circle border"></i>
							<i class="icon-circle selector" data-url="{{ url("api/survey/$key/save") }}" data-value="2" data-question-id="(data:id)" data-indicator=".indicator-question-(data:id)-2" data-question-row=".question-row-(data:id)"></i>
						</span>
						agree
					</td>
					<td class="indicator-question-(data:id)-3 (data:value=3)">
						<span class="circle-selector">
							<span class="connector"></span>
							<i class="icon-circle bg"></i>
							<i class="icon-circle border"></i>
							<i class="icon-circle selector" data-url="{{ url("api/survey/$key/save") }}" data-value="3" data-question-id="(data:id)" data-indicator=".indicator-question-(data:id)-3" data-question-row=".question-row-(data:id)"></i>
						</span>
						not sure
					</td>
					<td class="indicator-question-(data:id)-4 (data:value=4)">
						<span class="circle-selector">
							<span class="connector"></span>
						  	<i class="icon-circle bg"></i>
						  	<i class="icon-circle border"></i>
						  	<i class="icon-circle selector" data-url="{{ url("api/survey/$key/save") }}" data-value="4" data-question-id="(data:id)" data-indicator=".indicator-question-(data:id)-4" data-question-row=".question-row-(data:id)"></i>
						</span>
						disagree
					</td>
					<td class="indicator-question-(data:id)-5 (data:value=5)">
						<span class="circle-selector">
							<span class="connector last"></span>
						  	<i class="icon-circle bg"></i>
						  	<i class="icon-circle border"></i>
						  	<i class="icon-circle selector" data-url="{{ url("api/survey/$key/save") }}" data-value="5" data-question-id="(data:id)" data-indicator=".indicator-question-(data:id)-5" data-question-row=".question-row-(data:id)"></i>
						</span>
						strongly disagree
					</td>
				</tr>
			</table>
		</div>
	</div>

</script>