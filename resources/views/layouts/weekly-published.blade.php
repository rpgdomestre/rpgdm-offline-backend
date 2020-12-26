<!DOCTYPE html>
<html>
    <head>
        <base href="http://localhost:8888/">
        <link rel="stylesheet" href="{{ asset('css/rpgdm.css') }}">
        <style>
            .prose-blue a,
            .prose-blue h2,
            .prose-blue h3,
            .prose-blue h4,
            .prose-blue h6 {
                --tw-text-opacity: 1;
                color: rgba(37,99,235,var(--tw-text-opacity))
            }
            .prose-pink a,
            .prose-pink h2,
            .prose-pink h3,
            .prose-pink h4,
            .prose-pink h6 {
                --tw-text-opacity: 1;
                color: rgba(219,39,119,var(--tw-text-opacity))
            }
            .prose-yellow a,
            .prose-yellow h2,
            .prose-yellow h3,
            .prose-yellow h4,
            .prose-yellow h6 {
                --tw-text-opacity: 1;
                color: rgba(245,158,11,var(--tw-text-opacity))
            }
            .prose-gradient a,
            .prose-gradient h2,
            .prose-gradient h3,
            .prose-gradient h4,
            .prose-gradient h6 {
                --tw-text-opacity: 1;
                background-image: linear-gradient(to right, rgb(37, 99, 235), rgb(219, 39, 119), rgb(252, 211, 77));
                -webkit-background-clip: text;
                color: transparent;
            }
        </style>
</head>
    <body>
        <div class="container mx-auto p-4">
            @include("partials.published.single.header")
            {{ $slot }}
        </div>
        @include("partials.published.single.footer")
    </body>
</html>
