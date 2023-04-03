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

    @if (env('APP_ENV')=='prod' || env('APP_ENV')=='beta')
 <!-- Lucky orange for beta version -->
        <script type='text/javascript'>
            window.__lo_site_id = 286885;

            (function() {
                var wa = document.createElement('script'); wa.type = 'text/javascript'; wa.async = true;
                wa.src = 'https://d10lpsik1i8c69.cloudfront.net/w.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(wa, s);
            })();
        </script>
 <!-- end lucky orange for beta version -->
        @endif

    @if (env('APP_ENV')=='prod')
        <!-- Hotjar Tracking Code for dohzy.com -->
            <script>
                (function(h,o,t,j,a,r){
                    h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                    h._hjSettings={hjid:2284607,hjsv:6};
                    a=o.getElementsByTagName('head')[0];
                    r=o.createElement('script');r.async=1;
                    r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                    a.appendChild(r);
                })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
            </script>


            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=G-6CCEFQS7D8"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', 'G-6CCEFQS7D8');
            </script>
        @endif


    </head>
    <body>
     <div id="app">
         @include('partials._navbar')
               @yield('content')



         @include('partials._footer')

        <!-- Boostrap JS dependcies-->
        @include('partials._scripts')

        @yield('scripts') <!-- page specific script -->
     </div>
    </body>
</html>
