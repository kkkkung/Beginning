<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirm Your Email</title>
</head>
<body>
<h1>Thanks for you sign up this Web</h1>
<p>Pls click here <a href="{{ route('email_confirm', [$user->activation_token]) }}">{{ route('email_confirm', [$user->activation_token]) }}</a> to confirm your email address and active your account.</p>

<p>If this activity does not by you operation please ignore this Email and accept our apologetic.</p>
</body>
</html>