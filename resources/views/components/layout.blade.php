<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Lorem Jobs - API</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- favicon settings -->

    <link rel="manifest" href="/site.webmanifest">
    <meta name="theme-color" content="#ffffff">


    <!-- link to tailwindcss -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/images/*'])
</head>

<body class="m-auto font-sans text-primary antialiased bg-gradient-color min-h-screen max-w-6xl ">

    <div class="flex items-center justify-center rounded  w-full h-full bg-black/20 ">
        <div class="w-full px-1">{{ $slot }}</div>
    </div>

</body>

</html>
