<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<header class="bg-red-800 py-2">
    <nav class="flex flex-row justify-between container">
        <div class="">Logo</div>
        <ul class="flex flex-row justify-between space-x-8">
            <li>1</li>
            <li>2</li>
            <li>3</li>
            <li class="bg-blue-400 rounded-lg p-1 px-4"><a href="">Login</a></li>
        </ul>
    </nav>
</header>

<body class="antialiased">

</body>
<footer>

</footer>

</html>