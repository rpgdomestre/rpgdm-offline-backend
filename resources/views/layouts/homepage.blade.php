<!DOCTYPE html>
<html>
    <head>
        <base href="{{ config('rpgdm.url') }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ $metaDescription }}">
        <link rel="stylesheet" href="{{ config('rpgdm.url')}}css/rpgdm.css">
        <link rel="icon" type="image/png" href="{{ config('rpgdm.url')}}images/mestre.png" />
        <title>{{ $metaTitle }}</title>
    </head>
    <body>
        {{ $slot }}
        @include("partials.published.single.footer")
    </body>
</html>
