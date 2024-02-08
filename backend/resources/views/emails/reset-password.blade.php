<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Password Reset</title>
</head>

<body>
  <p>Hello,</p>
  <p>You are receiving this email because we received a password reset request for your account.</p>
  <p>Use the following token to reset your password: <strong>{{ $token }}</strong></p>
  <p>Please note that this token is valid for 24 hours. If you don't use it within this time frame, you'll need to
    request a new password reset link.</p>
  <p>If you did not request a password reset, no further action is required.</p>
</body>

</html>