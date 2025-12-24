@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl">Dashboard</h1>
    <p>Selamat datang, {{ auth()->user()->name }}! 👋</p>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
    <div class="card" style="border-left: 4px solid #2563eb;">
        <h3 style="color: #6b7280; font-size: 0.875rem; margin-bottom: 0.5rem;">Total Service Providers</h3>
        <p style="font-size: 2rem; font-weight: bold; color: #2563eb;">{{ $totalServiceProviders }}</p>
        <a href="{{ route('service-providers.index') }}" style="color: #2563eb; text-decoration: none; font-size: 0.875rem;">Lihat semua →</a>
    </div>

    <div class="card" style="border-left: 4px solid #10b981;">
        <h3 style="color: #6b7280; font-size: 0.875rem; margin-bottom: 0.5rem;">Total Kategori</h3>
        <p style="font-size: 2rem; font-weight: bold; color: #10b981;">{{ $totalCategories }}</p>
        <a href="{{ route('categories.index') }}" style="color: #10b981; text-decoration: none; font-size: 0.875rem;">Lihat semua →</a>
    </div>
</div>

<div class="card">
    <h2 class="text-xl mb-4">Service Provider Terbaru</h2>
    @if($recentServiceProviders->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentServiceProviders as $provider)
                    <tr>
                        <td>{{ $provider->name }}</td>
                        <td>{{ $provider->category->name }}</td>
                        <td>{{ $provider->phone ?? '-' }}</td>
                        <td>
                            <a href="{{ route('service-providers.show', $provider->uuid) }}" class="btn btn-primary" style="font-size: 0.875rem;">Lihat</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="text-align: center; color: #6b7280; padding: 2rem;">Belum ada service provider.</p>
    @endif
</div>
@endsection
