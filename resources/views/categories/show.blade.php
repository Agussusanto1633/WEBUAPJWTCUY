@extends('layouts.app')

@section('title', 'Detail Kategori')

@section('content')
<div class="mb-6">
    <a href="{{ route('categories.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">← Kembali</a>
</div>

<div class="bg-white rounded-lg shadow-sm p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ $category->name }}</h1>

    @if($category->description)
        <p class="text-gray-500 mb-6">{{ $category->description }}</p>
    @endif

    <div class="mb-6">
        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full">{{ $category->serviceProviders->count() }} Service Provider</span>
    </div>

    <div class="mt-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Service Providers dalam Kategori Ini</h2>
        @if($category->serviceProviders->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 border-b">No</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 border-b">Nama</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 border-b">Telepon</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 border-b">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($category->serviceProviders as $index => $provider)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 border-b border-gray-100">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 border-b border-gray-100 font-medium">{{ $provider->name }}</td>
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
            <p class="text-center text-gray-500 py-8">Belum ada service provider dalam kategori ini.</p>
        @endif
    </div>

    <div class="flex gap-3 mt-8">
        <a href="{{ route('categories.edit', $category->uuid) }}" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">Edit Kategori</a>
        <form action="{{ route('categories.destroy', $category->uuid) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
        </form>
    </div>
</div>
@endsection
