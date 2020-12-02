<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Vbaraholke</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    <link href="{{ asset('css/chat.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,300' rel='stylesheet' type='text/css'>
</head>
<body>
<div id="app">
    <app></app>
</div>
</body>

<script src="{{ mix('js/app.js') }}"></script>
</html>

