<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome Email</title>
</head>

<body>
  <h1>Welcome to Creative Guild Platform, {{ $user->name }}!</h1>

  <p>We're excited to have you on board. Thank you for signing up.</p>

  <p>Your account details:</p>
  <ul>
    <li>Name: {{ $user->name }}</li>
    <li>Email: {{ $user->email }}</li>
    <li>Phone: {{ $user->phone }}</li>
  </ul>

  <p>If you have any questions or need assistance, feel free to contact us.</p>

  <p>Best regards,<br> Your Platform Team</p>
</body>

</html>