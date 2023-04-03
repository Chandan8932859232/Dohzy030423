<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dohzy - @yield('title') </title>

        <meta name="description" content="@yield('description')">
        <meta name="keywords" content="@yield('keywords')">

        <!--Boostrap version 4.2.1  CDN -->
         @include('partials._stylesheets')

    </head>
    <body>
      <div id="app">
          @include('partials._navbar')


          <div class="row">
          {{-- @if (Auth::check()) --}}  <!--check if user is logged in -->
              <div class ="col-2">
                     @include('partials._admin-sidebar')
                 </div>
            {{--  @endif --}}

            <div class ="col-10">
               @include('partials._searchform')
               @include('partials._messages')
               @yield('content')
             </div>

          </div>

        <!-- Boostrap JS dependcies-->
        @include('partials._scripts')

        @yield('scripts') <!-- page specific script -->
     </div>
    </body>
</html>
