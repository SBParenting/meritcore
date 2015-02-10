
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
						<div class="slider slider-horizontal">
							<div class="slider-track">
								<div class="slider-selection" style="left: 0%; width: 80%;"> </div>
								<div class="slider-handle min-slider-handle round" tabindex="0" style="left 90%; "></div>
								<div class=" slider-handle max-slider-handle round hide"></div>
							</div>


						</div>
						
					</td>
					<td>
						
					</td>
					<td>
						
					</td>
					<td>
					
					</td>
					<td>
				
					</td>
				</tr>
			</table>
		</div>
	</div>
@endforeach