<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @include('student.include.headerLink')

</head>

<body class="hold-transition login-page">
    @yield('content')
    @include('student.include.footerLink')

</body>

</html>