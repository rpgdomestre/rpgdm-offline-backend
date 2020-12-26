<!DOCTYPE html>
<html>
    <head>
        <base href="http://localhost:8888/">
        <link rel="stylesheet" href="{{ asset('css/rpgdm.css') }}">
        </style>
</head>
    <body>
        {{ $slot }}
        @include("partials.published.single.footer")
    </body>
</html>
