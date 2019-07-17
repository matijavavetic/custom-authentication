<!DOCTYPE html>
<html>
<head>
    <title>Lost password</title>
</head>

<body>
    <h1>Hi there {{ $data['name'] }}</h1>

    <p>Reset your password using the link below.</p>

    <a href="{{url('password/reset', $data['lost_password_token'])}}">Reset password</a>
</body>

</html>