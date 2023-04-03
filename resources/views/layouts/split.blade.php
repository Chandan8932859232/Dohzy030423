<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title> Dohzy - @yield('title') </title>

        <meta name="description" content="@yield('description')">
        <meta name="keywords" content="@yield('keywords')">

        <!--Boostrap version 4.2.1  CDN -->
         @include('partials._stylesheets')

    <!-- placeholder to insert page specific style -->
        @stack('page_specific_style')
    <!-- End page specific style -->

    </head>
    <body>
      <div id="app">
        {{--@include('partials._navbar')--}}

        @yield('left-content')

        @yield('right-content')


 <!-- Boostrap JS dependcies-->
        @include('partials._scripts')

        @yield('scripts') <!-- page specific script -->
    </div>
    </body>
</html>



