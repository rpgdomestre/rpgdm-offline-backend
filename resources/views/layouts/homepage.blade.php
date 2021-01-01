<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <base href="{{ config('rpgdm.url') }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ $metaDescription }}">
        <link rel="stylesheet" href="{{ config('rpgdm.url')}}css/rpgdm.css">
        <link rel="icon" type="image/png" href="{{ config('rpgdm.url')}}images/mestre.png" />
        <meta http-equiv="Content-Language" content="pt-br">
        <title>{{ $metaTitle }}</title>
    </head>
    <body>
        {{ $slot }}
        @include("partials.published.single.footer")
    </body>
</html>
