@extends('layouts.app')

@section('title', 'Service Providers')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Service Providers</h1>
    <a href="{{ route('service-providers.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">+ Tambah Service Provider</a>
</div>

<div class="bg-white rounded-lg shadow-sm p-6">
    @if($serviceProviders->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 border-b">No</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 border-b">Foto</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 border-b">Nama</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 border-b">Kategori</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 border-b">Telepon</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($serviceProviders as $index => $provider)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 border-b border-gray-100">{{ ($serviceProviders->currentPage() - 1) * $serviceProviders->perPage() + $index + 1 }}</td>
                            <td class="px-4 py-3 border-b border-gray-100">
                                @if($provider->photo)
                                    <img src="{{ asset('storage/' . $provider->photo) }}" alt="{{ $provider->name }}" class="w-12 h-12 object-cover rounded">
                                @else
                                    <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center text-gray-400">-</div>
                                @endif
                            </td>
                            <td class="px-4 py-3 border-b border-gray-100 font-medium">{{ $provider->name }}</td>
                            <td class="px-4 py-3 border-b border-gray-100">
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">{{ $provider->category->name }}</span>
                            </td>
                            <td class="px-4 py-3 border-b border-gray-100 text-gray-600">{{ $provider->phone ?? '-' }}</td>
                            <td class="px-4 py-3 border-b border-gray-100">
                                <div class="flex gap-2">
                                    <a href="{{ route('service-providers.show', $provider->uuid) }}" class="px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition">Lihat</a>
                                    <a href="{{ route('service-providers.edit', $provider->uuid) }}" class="px-3 py-1 bg-green-500 text-white text-sm rounded hover:bg-green-600 transition">Edit</a>
                                    <form action="{{ route('service-providers.destroy', $provider->uuid) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600 transition" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-center">
            {{ $serviceProviders->appends(request()->query())->links() }}
        </div>
    @else
        <p class="text-center text-gray-500 py-8">Belum ada service provider.</p>
    @endif
</div>
@endsection
