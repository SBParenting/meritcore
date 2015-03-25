<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		@include('emails.style')
	</head>
	<body>
		<h2>{{ Config::get('site.title') }} Login Information</h2>

		<p>Hi there,</p>

		<p>This is a reminder regarding your Exploratory phase.</p>

		<p>
			You're Exploring: <em>{{ $explore->question }}</em></br>
			And you're Building: <em>{{ isset($build) ? $build->option : "nothing. what a shame." }}</em>
		</p>
	</body>
</html>
