<!DOCTYPE html>
<html lang="en">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <head>
        @vite(['resources/js/app.js'])
    </head>
<body>
    <div id="app"></div>
</body>
</html>