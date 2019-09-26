<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Ecommerce Dashboard &mdash; Stisla</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Page Style -->
    @yield('style')

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ mix('css/style.css') }}">
</head>

<body>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        @include('shared.header')

        @include('shared.sidebar')

        <!-- Main Content -->
        @yield('content')

        @include('shared.footer')
    </div>
</div>

<!-- General JS Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

<!-- JS Libraies -->
{{--<script src="{{ asset('stisla/modules/jquery.sparkline.min.js') }}"></script>--}}
{{--<script src="{{ asset('stisla/modules/chart.min.js') }}"></script>--}}
{{--<script src="{{ asset('stisla/modules/owlcarousel2/dist/owl.carousel.min.js') }}"></script>--}}
{{--<script src="{{ asset('stisla/modules/summernote/summernote-bs4.js') }}"></script>--}}
{{--<script src="{{ asset('stisla/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>--}}

<!-- Page Specific JS File -->
@yield('script')

<!-- Template JS File -->
<script src="{{ mix('js/template.js') }}"></script>
</body>
</html>
