@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
    <p class="text-gray-600">Selamat datang, {{ auth()->user()->name }}! 👋</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-blue-600">
        <h3 class="text-gray-500 text-sm mb-2">Total Service Providers</h3>
        <p class="text-4xl font-bold text-blue-600">{{ $totalServiceProviders }}</p>
        <a href="{{ route('service-providers.index') }}" class="text-blue-600 hover:text-blue-700 text-sm mt-2 inline-block">Lihat semua →</a>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-green-500">
        <h3 class="text-gray-500 text-sm mb-2">Total Kategori</h3>
        <p class="text-4xl font-bold text-green-500">{{ $totalCategories }}</p>
        <a href="{{ route('categories.index') }}" class="text-green-500 hover:text-green-600 text-sm mt-2 inline-block">Lihat semua →</a>
    </div>
</div>

<div class="bg-white rounded-lg shadow-sm p-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Service Provider Terbaru</h2>
    @if($recentServiceProviders->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 border-b">Nama</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 border-b">Kategori</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 border-b">Telepon</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentServiceProviders as $provider)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 border-b border-gray-100">{{ $provider->name }}</td>
                            <td class="px-4 py-3 border-b border-gray-100">
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">{{ $provider->category->name }}</span>
                            </td>
                            <td class="px-4 py-3 border-b border-gray-100 text-gray-600">{{ $provider->phone ?? '-' }}</td>
                            <td class="px-4 py-3 border-b border-gray-100">
                                <a href="{{ route('service-providers.show', $provider->uuid) }}" class="px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition">Lihat</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-center text-gray-500 py-8">Belum ada service provider.</p>
    @endif
</div>
@endsection
