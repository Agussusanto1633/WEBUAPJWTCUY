<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Jasa Cuci Mobil & Motor')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">
    @auth
        <nav class="bg-blue-600 text-white shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <a href="{{ route('dashboard') }}" class="text-xl font-bold text-white hover:text-blue-100 transition">
                        🚗 Jasa Cuci Mobil & Motor
                    </a>
                    <ul class="flex items-center gap-1">
                        <li>
                            <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-lg hover:bg-blue-700 transition">Dashboard</a>
                        </li>
                        <li>
                            <a href="{{ route('service-providers.index') }}" class="px-4 py-2 rounded-lg hover:bg-blue-700 transition">Service Providers</a>
                        </li>
                        <li>
                            <a href="{{ route('categories.index') }}" class="px-4 py-2 rounded-lg hover:bg-blue-700 transition">Kategori</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                Logout ({{ auth()->user()->name }})
                            </a>
                        </li>
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>
        </nav>
    @endauth

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @auth
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endauth

        @yield('content')
    </div>
</body>
</html>
