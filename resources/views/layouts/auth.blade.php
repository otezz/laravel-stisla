<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel &mdash; Stisla</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ mix('css/style.css') }}">
</head>

<body>
<div id="app">
    @yield('content')
</div>

<!-- General JS Scripts -->
<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ mix('js/template.js') }}"></script>

<!-- Page Specific JS File -->
@yield('script')

</body>
</html>
