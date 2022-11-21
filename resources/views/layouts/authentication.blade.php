<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/22cb3e2ea7.js" crossorigin="anonymous"></script>
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
    ])
    <title>{{ config('app.name') }}</title>
</head>
<body>
    @auth
        <header>
            <nav class="flex items-center p-4">
                <ul class="ml-auto flex items-center gap-4">
                    <li>
                        <a href="" class="block text-sm font-semibold px-4 py-2">Profile</a>
                    </li>
                    <li>
                        <form x-data method="POST" action="{{ route('logout') }}">
                            <a class="block text-sm font-semibold px-4 py-2" href="{{ route('logout') }}" @click.prevent="$event.target.closest('form').submit()">Logout</a>
                        </form>
                    </li>
                </ul>
            </nav>
        </header>
    @endauth
    <main class="flex flex-col items-center">
        @yield('content')
    </main>
</body>
</html>