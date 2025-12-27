<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @include('usersPage.include.headerLink')
   
</head>
 @include('usersPage.include.header')
<body class="hold-transition sidebar-mini">
    

    @yield('content')

    
   @include('usersPage.include.footer')
    @include('usersPage.include.footerLink')
   
    @yield('scripts')
</body>

</html>