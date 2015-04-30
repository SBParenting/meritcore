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
			Password: <em><a href="{{ URL::to('password/reset', array($token)) }}">Click here to set a new password</a></em>
		</p>

		Attention: The password link is valid for only 60 minutes. In case the link isn't valid anymore, contact your manager to send another email.

		<p><a href="{{ url('/login') }}">Log In on Meritcore</a></p>
	</body>
</html>
