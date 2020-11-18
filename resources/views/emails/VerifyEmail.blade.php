<!DOCTYPE html>
<html lang="en">

<body>
	
<p>Hello {{ $user->name }}</p>

<p>Welcome to our Throttle Rides Website </p>
<p>Your account has been created, please activate your account by clicking this link</p>
<p><a href="{{ route('verify',$user->email_verification_token) }}">
	Click here
</a></p>

<p>Thanks</p>

</body>

</html> 