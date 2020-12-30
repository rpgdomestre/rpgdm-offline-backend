<!DOCTYPE html>
<html>
    <head>
        <base href="{{ config('rpgdm.url') }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ $metaDescription }}">
        <link rel="stylesheet" href="{{ asset('css/rpgdm.css') }}">
        <link rel="icon" type="image/png" href="{{ asset('images/mestre.png') }}" />
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
