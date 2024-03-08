<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .cardWrap {
            width: 27em;
            margin: 3em auto;
            color: #fff;
            font-family: sans-serif;
        }

        .card {
            background: linear-gradient(
                to bottom,
                #e84c3d 0%,
                #e84c3d 26%,
                #ecedef 26%,
                #ecedef 100%
            );
            height: 16em;
            float: left;
            position: relative;
            padding: 1em;
            margin-top: 100px;
        }

        .cardLeft {
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
            width: 16em;
        }

        .cardRight {
            width: 8em;
            border-left: 0.18em dashed #fff;
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        h1 {
            font-size: 1.1em;
            margin-top: 0;
        }

        .title,
        .name,
        .seat,
        .time {
            text-transform: uppercase;
            font-weight: normal;
        }

        h2 {
            font-size: 0.9em;
            color: #525252;
            margin: 0;
        }

        span {
            font-size: 0.7em;
            color: #a2aeae;
        }

        .title {
            margin: 2em 0 0 0;
        }

        .name,
        .seat {
            margin: 0.7em 0 0 0;
        }

        .time {
            margin: 0.7em 0 0 1em;
        }

        .seat,
        .time {
            float: left;
        }

        .eye {
            position: relative;
            width: 2em;
            height: 1.5em;
            background: #fff;
            margin: 0 auto;
            border-radius: 1em/0.6em;
            z-index: 1;
        }

        .number {
            text-align: center;
            text-transform: uppercase;
        }

        h3 {
            color: #e84c3d;
            margin: 0.9em 0 0 0;
            font-size: 2.5em;
        }

        .barcode {
            height: 2em;
            width: 0;
            margin: 1.2em 0 0 0.8em;
            box-shadow: 1px 0 0 1px #343434, 5px 0 0 1px #343434, 10px 0 0 1px #343434,
            11px 0 0 1px #343434, 15px 0 0 1px #343434, 18px 0 0 1px #343434,
            22px 0 0 1px #343434, 23px 0 0 1px #343434, 26px 0 0 1px #343434,
            30px 0 0 1px #343434, 35px 0 0 1px #343434, 37px 0 0 1px #343434,
            41px 0 0 1px #343434, 44px 0 0 1px #343434, 47px 0 0 1px #343434,
            51px 0 0 1px #343434, 56px 0 0 1px #343434, 59px 0 0 1px #343434,
            64px 0 0 1px #343434, 68px 0 0 1px #343434, 72px 0 0 1px #343434,
            74px 0 0 1px #343434, 77px 0 0 1px #343434, 81px 0 0 1px #343434;
        }

    </style>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    @include('layouts.navigation')

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main>
        <div class="cardWrap">
            <div class="card cardLeft">
                <h1>Event</h1>
                <div class="title">
                    <h2>{{$ticket->event->title}}</h2>
                    <span>event</span>
                </div>
                <div class="name">
                    <h2>{{$ticket->user->name}}</h2>
                    <span>name</span>
                </div>
                <div class="seat">
                    <h2>{{$ticket->event->reservation->id}}</h2>
                    <span>seat</span>
                </div>
                <div class="time">
                    <h2>{{$ticket->event->date}}</h2>
                    <span>Date</span>
                </div>

            </div>
            <div class="card cardRight">
                <div class="eye"></div>
                <div class="number">
                    <h3>{{$ticket->event->reservation->id}}</h3>
                    <span>seat</span>
                </div>
                <div class="barcode"></div>
            </div>

        </div>
    </main>
</div>
</body>
</html>
