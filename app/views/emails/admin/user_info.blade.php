<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		@include('emails.style')
	</head>
	<body>
		<h2>{{ Config::get('site.title') }} Login Information</h2>

		<p>Hi there,</p>

		<p>Your account is <b>{{ $user->status }}</b> on {{ Config::get('site.title') }}. You may log in using the following details:</p>

		<p>
			Username: <em>{{ $user->username }}</em></br>
			Password: <em>The password you specified</em>
		</p>
	</body>
</html>
