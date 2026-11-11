<!DOCTYPE html>
<html lang="en">

<head>
    @include('include.head')
</head>
<body class="{{ Request::is('/') ? 'common-home' : 'information' }}">
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WMB9NT3Q"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->

    <div class="page-wrapper">
        {{-- Removed preloader section --}}

        @include('include.navigation')

        @yield('content')

        <!-- footer -->
        @include('include.footer')
        <!-- end footer -->

    </div>

    @include('include.script')
    @yield('script')
</body>
</html>
