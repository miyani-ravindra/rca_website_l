<!DOCTYPE html>
<html lang="en">

<head>

@include('layouts.header')

</head>
<body>
@include('layouts.top_header')
@include('layouts.menu')

@yield('product_bg')

@yield('content')

<!-- page specific scripts -->
@yield('pagespecificscripts')

@include('layouts.top_footer')

@include('layouts.bottom_footer')
