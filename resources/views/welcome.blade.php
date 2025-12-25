<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JasaCuci - Layanan Cuci Mobil & Motor Premium</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-800 bg-white">
    <!-- Header / Navigation -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-100" id="header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-2 text-xl font-bold text-blue-600">
                    <span class="w-9 h-9 bg-gradient-to-br from-blue-600 to-green-500 rounded-lg flex items-center justify-center text-white">🚗</span>
                    <span>JasaCuci</span>
                </a>

                <!-- Navigation Actions -->
                @auth
                    <div class="flex items-center gap-3">
                        <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition">Dashboard</a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition">Logout</button>
                        </form>
                    </div>
                @else
                    <div class="flex items-center gap-3">
                        <a href="{{ route('login') }}" class="px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition">Masuk</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-lg shadow-blue-600/30 transition">Daftar Sekarang</a>
                    </div>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 bg-gradient-to-b from-blue-50 to-white overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_80%,rgba(0,102,255,0.08)_0%,transparent_50%),radial-gradient(circle_at_80%_20%,rgba(0,199,129,0.08)_0%,transparent_50%)]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center max-w-3xl mx-auto">
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-full text-sm text-gray-600 shadow-sm mb-6">
                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                    <span>Platform Terpercaya Sejak 1945</span>
                </div>

                <!-- Title -->
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight mb-6">
                    Layanan Cuci <span class="bg-gradient-to-r from-blue-600 to-green-500 bg-clip-text text-transparent">Mobil & Motor</span> Terbaik di Indonesia
                </h1>

                <!-- Description -->
                <p class="text-lg text-gray-600 leading-relaxed mb-10 max-w-2xl mx-auto">
                    Temukan penyedia jasa cuci kendaraan profesional dengan kualitas terjamin dan harga transparan di sekitar Anda
                </p>

                <!-- CTA Buttons -->
                @auth
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto px-8 py-4 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-600/30 transition">
                            🚀 Masuk Dashboard
                        </a>
                    </div>
                @else
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-600/30 transition">
                            Mulai Sekarang
                        </a>
                        <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-4 border-2 border-blue-600 text-blue-600 font-semibold rounded-xl hover:bg-blue-600 hover:text-white transition">
                            Sudah Punya Akun?
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6">
                    <div class="text-4xl font-extrabold text-blue-600 mb-2">{{ $serviceProviders->count() }}+</div>
                    <div class="text-sm font-medium text-gray-500 uppercase tracking-wide">Service Provider</div>
                </div>
                <div class="text-center p-6">
                    <div class="text-4xl font-extrabold text-blue-600 mb-2">{{ $categories->count() }}+</div>
                    <div class="text-sm font-medium text-gray-500 uppercase tracking-wide">Kategori Layanan</div>
                </div>
                <div class="text-center p-6">
                    <div class="text-4xl font-extrabold text-blue-600 mb-2">24/7</div>
                    <div class="text-sm font-medium text-gray-500 uppercase tracking-wide">Dukungan Pelanggan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-blue-100 text-blue-600 text-xs font-bold uppercase tracking-wider rounded-full mb-4">
                    ✨ Layanan Kami
                </span>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-3">Service Provider Profesional</h2>
                <p class="text-lg text-gray-500 max-w-lg mx-auto">
                    Pilih penyedia jasa cuci kendaraan terbaik dengan kualitas layanan premium
                </p>
            </div>

            <!-- Services Grid -->
            @if($serviceProviders->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($serviceProviders as $provider)
                        <article class="bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-xl hover:border-transparent hover:-translate-y-1 transition-all duration-300">
                            <!-- Image -->
                            <div class="relative h-48 bg-gradient-to-br from-blue-600 to-green-500 flex items-center justify-center overflow-hidden">
                                @if($provider->photo)
                                    <img src="{{ asset('storage/' . $provider->photo) }}" alt="{{ $provider->name }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" loading="lazy">
                                @else
                                    <span class="text-6xl opacity-90">🚗</span>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <span class="inline-block px-3 py-1 bg-blue-100 text-blue-600 text-xs font-bold uppercase tracking-wide rounded-full mb-3">{{ $provider->category->name }}</span>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $provider->name }}</h3>
                                <p class="text-sm text-gray-500 leading-relaxed mb-4">
                                    {{ \Illuminate\Support\Str::limit($provider->description, 100) }}
                                </p>
                                @if($provider->phone)
                                    <div class="inline-flex items-center gap-2 px-3 py-2 bg-gray-50 rounded-lg text-sm font-semibold text-green-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                        <span>{{ $provider->phone }}</span>
                                    </div>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16 bg-white rounded-2xl border-2 border-dashed border-gray-200">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center text-4xl mx-auto mb-6">📭</div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Service Provider</h3>
                    <p class="text-sm text-gray-500">
                        Service provider akan segera tersedia. Silakan cek kembali nanti.
                    </p>
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col items-center text-center gap-6">
                <!-- Logo -->
                <div class="flex items-center gap-2 text-lg font-bold">
                    <span class="w-8 h-8 bg-gradient-to-br from-blue-600 to-green-500 rounded flex items-center justify-center text-sm">🚗</span>
                    <span>JasaCuci</span>
                </div>

                <!-- Divider -->
                <div class="w-full h-px bg-gray-700"></div>

                <!-- Bottom -->
                <div class="flex flex-col items-center gap-2">
                    <p class="text-sm text-gray-400">
                        &copy; 2025 JasaCuci. All rights reserved.
                    </p>
                    <p class="text-sm text-gray-500">
                        Made with ❤️ in Indonesia
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Header scroll effect
        const header = document.getElementById('header');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.add('shadow-sm');
            } else {
                header.classList.remove('shadow-sm');
            }
        });
    </script>
</body>
</html>
