<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @include('front.include.headerLink')
    @include('front.include.header')
</head>
<body>
    @yield('content')
   
    @include('front.include.footer')
     @include('front.include.footerLink')
</body>
</html>
