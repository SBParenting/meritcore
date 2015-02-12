@extends('front.layout.base')


@section('content')

	<div class="container">

		<div class="row">

			<!-- Blog Entries Column -->
			<div class="col-md-12">
			
				<h2>
					<a href="{{ url("/article/$post->slug") }}">{{ $post->title }}</a>
				</h2>
				
				<p><span class="fa fa-time"></span> Posted on {{ $post->created_at }}</p>
				<hr>
				<p>{{ $post->content }}</p>

			</div>

			
		</div>
	</div>

@stop