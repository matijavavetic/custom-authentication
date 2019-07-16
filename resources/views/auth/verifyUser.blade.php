<!DOCTYPE html>
<html>
<head>
    <title>Welcome!</title>
</head>

<body>
    <h1>Hi there, {{ $user['name'] }}!</h1>

    Verify your email and account by clicking on the button below.

    <a href="{{url('confirmation', $user['verificationToken'])}}">VERIFY</a>
</body>

</html>