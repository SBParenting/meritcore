<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		@include('emails.style')
	</head>
	<body>
		<h2>{{ Config::get('site.title') }} Account Verification</h2>

		<p>Hi there,</p>

		<p>You recently registered on {{ Config::get('site.title') }}. Please verify your account by clicking on the following link:</p>

		<h3><a href="{{ url('verify', ['code' => $user->verification_code]) }}">Verify my account</a></h3>

	</body>
</html>
