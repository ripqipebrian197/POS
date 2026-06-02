<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <!-- Isi title yang kita kirimkan dari views lain -->
    <title>@yield('title')</title>
    <!-- memanggil Link bootstrap -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>
<body>
    <div class="container">
        <!-- Isi content yang kita kirimkan dari views lain -->
        @yield('content')
    </div>
</body>
</html>