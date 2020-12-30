<!DOCTYPE html>
<html>
    <head>
        <base href="http://localhost:8888/">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ $metaDescription }}">
        <link rel="stylesheet" href="{{ asset('css/rpgdm.css') }}">
        <title>{{ $metaTitle }} | RPG do Mestre</title>
    </head>
    <body>
        <div class="container mx-auto p-4">
            @include("partials.published.single.header")
            {{ $slot }}
        </div>
        @include("partials.published.single.footer")
    </body>
</html>
