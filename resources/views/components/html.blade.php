<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Wedstrijdplatform' }}</title>
    @vite('resources/sass/app.scss')
    @vite('resources/js/app.js')
</head>
<body>
<x-navbar/>
<div class="container my-3">
    {{ $slot }}
</div>
</body>
</html>
