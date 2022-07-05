<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
Dear


Your

<h6>Dear {{$data['name']}}, Your {{$data['role']}} account has been successfully created. You can now log in to your account.</h6>
<table>
    <tr>
        <th>email</th>
        <td>Your Email Address</td>
    </tr>
        <th>password</th>
        <td>{{$data['password']}}</td>
    </tr>
    <tr>
        <th>Link</th>
        <td>{{env('APP_FRONTEND_URL')}}</td>
    </tr>
</table>
</body>
</html>
