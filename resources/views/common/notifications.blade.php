
@foreach(array('danger', 'success', 'warning', 'info') as $type)
	@if(Session::get($type) || isset($msg[$type]))
		<?php $has_msg = true; ?>
	@endif
@endforeach

<div id="notifications">

	@if (!empty($has_msg))

		@foreach(array('danger', 'success', 'warning', 'info') as $type)
			@if(Session::get($type))
				<div class="notification {{ $type }}"><i></i>{{ Session::get($type) }}</div>
			@endif

			@if(isset($msg[$type]))
				@if (is_array($msg[$type]))
					@foreach($msg[$type] as $row)
						<div class="notification {{ $type }}"><i></i>{{ $row }}</div>
					@endforeach
				@else
					<div class="notification {{ $type }}"><i></i>{{ $msg[$type] }}</div>
				@endif
			@endif
		@endforeach

	@endif

</div>