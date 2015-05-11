
<script type="text/template" id="questionTemplate">
	
	<div class="survey-row question-row-(data:id) (data:done=true)">
		<div class="container">
			<table>
				<tr>
					<td>
						<span class="circle-number">
							<i class="icon-circle"></i>
							<span class="color">(data:question_num)</span>
						</span>
					</td>
					<td>(data:title)</td>
					<td class="indicator-question-(data:id)-1 (data:value=1)">
						<span class="circle-selector">
							<span class="connector first"></span>
							<i class="icon-circle bg"></i>
							<i class="icon-circle border"></i>
								<i class="icon-circle selector" data-url="{{ url("api/survey/$key/savePost") }}" data-value="1" data-question-id="(data:id)" data-indicator=".indicator-question-(data:id)-1" data-question-row=".question-row-(data:id)"></i>
						</span>
						yes
					</td>
					<td class="indicator-question-(data:id)-2 (data:value=2)">
						<span class="circle-selector">
							<span class="connector last"></span>
						  	<i class="icon-circle bg"></i>
						  	<i class="icon-circle border"></i>
								<i class="icon-circle selector" data-url="{{ url("api/survey/$key/savePost") }}" data-value="2" data-question-id="(data:id)" data-indicator=".indicator-question-(data:id)-2" data-question-row=".question-row-(data:id)"></i>
						</span>
						no
					</td>
				</tr>
			</table>
		</div>
	</div>

</script>
