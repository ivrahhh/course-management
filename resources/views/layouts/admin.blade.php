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
    <header>
        <nav class="flex items-center px-4 py-2 bg-slate-900 text-gray-100">
            <a class="fa-brands fa-laravel text-gray-400 text-4xl"></a>
            <div class="ml-auto">
                <x-dropdown>
                    <x-slot name="toggler">
                        <button type="button" class="flex items-center text-sm px-4 py-2">
                            <i class="fa-solid fa-user-circle mr-2"></i>
                            {{ auth()->user()->name }}
                            <i class="fa-solid fa-caret-down ml-2"></i>
                        </button>
                    </x-slot>
                    <x-slot name="menu">
                        <a href="" class="block px-4 py-3 text-sm hover:bg-slate-800 text-white transition-colors ease-in duration-75">Profile</a>
                        <form action="{{ route('logout') }}" method="POST">
                            <a href="" class="block px-4 py-3 text-sm hover:bg-slate-800 text-white transition-colors ease-in duration-75" @click.prevent="$event.target.closest('form').submit()">Logout</a>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </nav>
    </header>
    <div class="flex relative">
        <aside class="sticky top-0 h-screen shadow w-64">
            
        </aside>
        <main class="flex flex-col">
            @yield('content')
        </main>
    </div>
</body>
</html>