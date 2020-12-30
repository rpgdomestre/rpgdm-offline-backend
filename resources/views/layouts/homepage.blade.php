<!DOCTYPE html>
<html>
    <head>
        <base href="http://localhost:8888/">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ $metaDescription }}">
        <link rel="stylesheet" href="{{ asset('css/rpgdm.css') }}">
        <title>{{ $metaTitle }}</title>
    </head>
    <body>
        {{ $slot }}
        @include("partials.published.single.footer")
    </body>
</html>
