<!--

=========================================================
* Swipe - Mobile App One Page Bootstrap 5 Template
=========================================================

* Product Page: https://themesberg.com/product/bootstrap/swipe-free-mobile-app-one-page-bootstrap-5-template
* Copyright 2020 Themesberg (https://www.themesberg.com)

* Coded by https://themesberg.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. Contact us if you want to remove it.

-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"><!-- Primary Meta Tags -->
    <title>{{ config('appearance.theme.site_title') }}</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta name="title" content="{{ config('appearance.theme.site_title') }}">
    <meta name="author" content="Themesberg">
    <meta name="description" content="{{ config('appearance.theme.site_description') }}">
    <meta name="keywords" content="{{ config('appearance.theme.site_keywords') }}">
    <link
        rel="canonical"href="https://themesberg.com/product/bootstrap/swipe-free-mobile-app-one-page-bootstrap-5-template">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="{{ config('appearance.theme.site_title') }}">
    <meta property="og:description" content="{{ config('appearance.theme.site_description') }}">
    <meta property="og:image"
        content="https://themesberg.s3.us-east-2.amazonaws.com/public/products/swipe/swipe-thumbnail.jpg">
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/') }}">
    <meta property="twitter:title" content="Swipe - Mobile App One Page Bootstrap 5 Template">
    <meta property="twitter:description" content="{{ config('appearance.theme.site_description') }}">
    <meta property="twitter:image"
        content="https://themesberg.s3.us-east-2.amazonaws.com/public/products/swipe/swipe-thumbnail.jpg">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="120x120" href="{{ theme_asset('assets/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ theme_asset('assets/img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ theme_asset('assets/img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ theme_asset('assets/img/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ theme_asset('assets/img/favicon/safari-pinned-tab.svg') }}" color="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff"><!-- Fontawesome -->
    <link type="text/css" href="{{ theme_asset('vendor/@fortawesome/fontawesome-free/css/all.min.css') }}"
        rel="stylesheet">
    <!-- Swipe CSS -->
    <link type="text/css" href="{{ theme_asset('css/swipe.css') }}" rel="stylesheet">
</head>

<body>
    @include('partials.header')
    <main>
        @yield('content')
    </main>
    @include('partials.footer')
    <script src="{{ theme_asset('/vendor/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ theme_asset('/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ theme_asset('/vendor/headroom.js/dist/headroom.min.js') }}"></script><!-- Vendor JS -->
    <script src="{{ theme_asset('/vendor/onscreen/dist/on-screen.umd.min.js') }}"></script>
    <script src="{{ theme_asset('/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
    <script src="{{ theme_asset('/assets/js/swipe.js') }}"></script>
</body>

</html>
