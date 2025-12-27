<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @include('admin.include.headerLink')
  
</head>
 
<body class="hold-transition sidebar-mini">
     @include('admin.include.header')

    @yield('content')
   @include('admin.include.footer')
    @include('admin.include.footerLink')
   
    @yield('scripts')
</body>

</html>