<!DOCTYPE html>
<html lang="en" data-footer="true">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <?php $settings = \App\Http\Controllers\AdminHomeController::getSetting(); ?>
    <title>{{ $settings->app_name }} </title>

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
    <link rel="stylesheet" href="{{ asset('public/font/') }}/CS-Interface/style.css" />
    <!-- Font Tags End -->
    <!-- Vendor Styles Start -->
    <link rel="stylesheet" href="{{ asset('public/css/') }}/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('public/css/') }}/vendor/OverlayScrollbars.min.css" />
    <link rel="stylesheet" href="{{ asset('public/css/') }}/vendor/datatables.min.css" />
    <link rel="stylesheet" href="{{ asset('public/css/') }}/vendor/select2.min.css" />

    <link rel="stylesheet" href="{{ asset('public/css/') }}/vendor/select2-bootstrap4.min.css" />
    <!-- Vendor Styles End -->
    <!-- Template Base Styles Start -->
    <link rel="stylesheet" href="{{ asset('public/css/') }}/styles.css" />
    <!-- Template Base Styles End -->

    <link rel="stylesheet" href="{{ asset('public/css/') }}/main.css" />
    <script src="{{ asset('public/js/') }}/base/loader.js"></script>
    <script src="{{ asset('public/js/') }}/Sortable.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300&subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin+Sketch" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Sacramento" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Jura:400,500&amp;subset=cyrillic-ext" rel="stylesheet">


    <style>
        a {
            text-decoration: none;
        }

        body {

            font-family: arial;
            background: rgba(44, 124, 188, 0.05);
        }

        .task-board {
            background: #fff;
            display: inline-block;
            padding: 12px;
            border-radius: 3px;
            width: 98%;
            height: 95%;
            white-space: nowrap;
            overflow-x: scroll;
            min-height: 300px;

        }

        .status-card {
            width: 250px;
            margin-right: 8px;
            border-radius: 3px;
            display: inline-block;
            vertical-align: top;
            font-size: 0.9em;
            background-color: #fff;
            border: 1px solid rgba(19, 35, 47, 0.9);
            border-radius: 4px;
            box-shadow: 0 2px 4px 2px rgba(19, 35, 47, 0.3);
        }



        .card-header {
            width: 100%;
            padding: 10px 10px 0px 10px;
            box-sizing: border-box;
            border-radius: 3px;
            display: block;
            font-weight: bold;
        }

        .add_item_button {
            width: 100%;
            padding: 10px 10px 0px 10px;
            box-sizing: border-box;
            border-radius: 3px;
            display: block;
            font-weight: bold;
            background: #2c7cbc;
            background-color: rgb(100, 92, 165);
            font-family: Arial, Helvetica, sans-serif;
        }

        .card-header-text {
            display: block;
            width: 100%;
        }

        .card-header-act {
            display: block;
            float: right;
        }

        ul.sortable {
            padding-bottom: 10px;
        }

        .list:first-child {
            background-color: red;
        }

        ul li:first-child {
            border: 2px solid orange;
        }

        ul.sortable li:last-child {
            margin-bottom: 0px;
        }

        ul {
            list-style: none;
            margin: 0;
            padding: 0px;
        }

        .text-row {
            padding: 15px 10px;
            margin: 10px;
            box-sizing: border-box;
            cursor: pointer;
            font-size: 0.8rem;
            white-space: normal;
            line-height: 20px;
            background-color: #fff;
            border: 1px solid rgba(44, 124, 188, 0.5);
            border-radius: 3px;
            box-shadow: 0 1px 1px 1px rgba(19, 35, 47, 0.1);
        }

        .text-row:hover {
            border: 1px solid rgba(26, 177, 136, 0.5);
        }

        .text-row:focus {
            border: 1px solid rgba(26, 177, 136, 0.5);
        }

        .ui-sortable-placeholder {
            visibility: inherit !important;
            background: transparent;
            border: #777 2px dashed;
        }

        /*form*/
        .add_form {
            width: 240;
            background: rgba(19, 35, 47, 0.9);
            padding: 4px;

            margin: 0;
            margin-left: auto;
            margin-right: auto;
            border-radius: 4px;
            box-shadow: 0 4px 10px 4px rgba(19, 35, 47, 0.3);

        }


        input,
        textarea {
            color: #1ab188;
            width: 100%;
            padding: 5px 5px;
            background: none;
            background-image: none;
            border: 1px solid #a0b3b0;
            color: #ffffff;
            border-radius: 1px;
            -webkit-transition: border-color .25s ease, box-shadow .25s ease;
            transition: border-color .25s ease, box-shadow .25s ease;


        }

        input:focus {
            outline: 0;
            border-color: #1ab188;
        }

        input:hover {
            border-color: #93c25d;
        }

        .button {
            border: 0;
            outline: none;
            border-radius: 0;
            padding: 5px 0;
            font-size: 1rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: .1em;
            background: #1ab188;
            color: #ffffff;
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease;
            -webkit-appearance: none;
        }

        .button_card {
            background: rgba(44, 124, 188, 0.3);
        }

        .button:hover {
            background: #179b77;
        }

        .button:focus {
            background: #179b77;
        }


        .button-block {
            display: block;
            width: 100%;
        }

        .delete {
            color: rgba(44, 124, 188, 0.3);
            font-size: 0.9rem;
        }

        .delete:hover {
            color: rgba(19, 35, 47, 0.9);
        }

        .material-icons {
            font-size: 0.9rem;
        }

        .item1 {
            grid-area: header;
        }

        .item2 {
            grid-area: menu;
        }

        .item3 {
            grid-area: main;
        }

        .item4 {
            grid-area: right;
        }

        .item5 {
            grid-area: footer;
        }

        .grid-container {
            display: grid;
            grid-template-areas:

                'menu main main main right right'

                gap: 10px;
            background-color: #2196F3;
            padding: 10px;
        }

        .grid-container>div {
            background-color: rgba(255, 255, 255, 0.8);
            text-align: center;
            padding: 20px 0;
            font-size: 30px;
        }
    </style>
</head>

<body>
    <div id="root">
