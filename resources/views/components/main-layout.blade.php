<!DOCTYPE html>
<html lang="en">

<x-header></x-header>

<body>

    <div id="app">

        @if (request()->is('intern_register') || request()->is('list_intern_register/*'))

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Layout Pendaftaran Magang</title>
                <link rel="stylesheet" href="./assets/compiled/css/app.css">
                <link rel="stylesheet" href="./assets/compiled/css/app-dark.css">
            </head>

            <body>
                {{ $slot }}
            </body>
        @else
            <!-- Konten umum untuk layout lainnya -->
            <x-sidebar></x-sidebar>

            <div id="main" class='layout-navbar navbar-fixed'>
                <header>
                    <x-navbar></x-navbar>
                </header>

                <div id="main-content">
                    {{ $slot }}
                </div>
            </div>
        @endif

    </div>

    <x-script></x-script>
</body>

</html>
