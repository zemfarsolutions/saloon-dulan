<!DOCTYPE html>
<html lang="en" data-footer="true">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <?php $settings = \App\Http\Controllers\AdminHomeController::getSetting(); ?>
    <title>{{ $settings->app_name }} </title>
    <!--     refresh -->
    <!--      <meta http-equiv="refresh" content="30" /> -->
    <!-- Favicon Tags Start -->

    <meta name="application-name" content="&nbsp;" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-square310x310logo" content="img/favicon/mstile-310x310.png" />
    <!-- Favicon Tags End -->
    <!-- Font Tags Start -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/png" href="{{ asset('img/favicon/') }}/{{ $settings->app_icon }}" sizes="32x32" />
    <link rel="stylesheet" href="{{ asset('/font/') }}/CS-Interface/style.css" />
    <!-- Font Tags End -->
    <!-- Vendor Styles Start -->
    <link rel="stylesheet" href="{{ asset('/css/') }}/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('/css/') }}/vendor/OverlayScrollbars.min.css" />
    <link rel="stylesheet" href="{{ asset('/css/') }}/vendor/datatables.min.css" />
    <link rel="stylesheet" href="{{ asset('/css/') }}/vendor/select2.min.css" />

    <link rel="stylesheet" href="{{ asset('/css/') }}/vendor/select2-bootstrap4.min.css" />
    <!-- Vendor Styles End -->
    <!-- Template Base Styles Start -->
    <link rel="stylesheet" href="{{ asset('/css/') }}/styles.css" />
    <!-- Template Base Styles End -->

    <link rel="stylesheet" href="{{ asset('/css/') }}/main.css" />
    <script src="{{ asset('/js/') }}/base/loader.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css"
        integrity="sha512-hwwdtOTYkQwW2sedIsbuP1h0mWeJe/hFOfsvNKpRB3CkRxq8EW7QMheec1Sgd8prYxGm1OM9OZcGW7/GUud5Fw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body style="background-image: url('/img/logo/background.png'); overflow: hidden;">
    <div id="root">
