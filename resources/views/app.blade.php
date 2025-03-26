<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" />
    {{-- <link rel="stylesheet" href="{{ asset('content/css/bootstrap.min.css') }}"> --}}
    @include('partials.css')
    @vite(['resources/js/app.js'])
</head>


<body>
    <div id="adminApp" class="wrapper">
        <router-view></router-view>
        <vue-progress-bar></vue-progress-bar>
    </div>
</body>

</html>
