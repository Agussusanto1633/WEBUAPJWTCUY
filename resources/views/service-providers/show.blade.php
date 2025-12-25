@extends('layouts.app')

@section('title', 'Detail Service Provider')

@section('content')
<div class="mb-6">
    <a href="{{ route('service-providers.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">← Kembali</a>
</div>

<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div>
            @if($provider->photo)
                <img src="{{ asset('storage/' . $provider->photo) }}" alt="{{ $provider->name }}" class="w-full rounded-lg">
            @else
                <div class="w-full aspect-square bg-gray-200 rounded-lg flex items-center justify-center text-gray-400 text-6xl">📷</div>
            @endif
        </div>

        <div class="md:col-span-2">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ $provider->name }}</h1>

            <div class="mb-4">
                <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm rounded-full">{{ $provider->category->name }}</span>
            </div>

            @if($provider->phone)
                <div class="mb-4">
                    <p class="font-semibold text-gray-700">Telepon:</p>
                    <p class="text-blue-600">{{ $provider->phone }}</p>
                </div>
            @endif

            @if($provider->address)
                <div class="mb-4">
                    <p class="font-semibold text-gray-700">Alamat:</p>
                    <p class="text-gray-600">{{ $provider->address }}</p>
                </div>
            @endif

            @if($provider->description)
                <div class="mb-4">
                    <p class="font-semibold text-gray-700">Deskripsi:</p>
                    <p class="text-gray-600">{{ $provider->description }}</p>
                </div>
            @endif

            <div class="flex gap-3 mt-8">
                <a href="{{ route('service-providers.edit', $provider->uuid) }}" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">Edit</a>
                <form action="{{ route('service-providers.destroy', $provider->uuid) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
