<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laila Fried Chicken</title>
    @viteReactRefresh
    @vite(['resources/js/LandingPage.jsx']) <!-- Hubungkan React -->
</head>

<body>
    <div id="landing-page"></div> <!-- React akan dirender di sini -->
</body>

</html>