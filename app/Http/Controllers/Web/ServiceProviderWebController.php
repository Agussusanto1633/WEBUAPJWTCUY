<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ServiceProvider;
use App\Models\Category;

class ServiceProviderWebController extends Controller
{
    /**
     * Display a listing of service providers
     */
    public function index()
    {
        $serviceProviders = ServiceProvider::with('category')
            ->latest()
            ->paginate(10);

        return view('service-providers.index', compact('serviceProviders'));
    }

    /**
     * Show the form for creating a new service provider
     */
    public function create()
    {
        $categories = Category::all();
        return view('service-providers.create', compact('categories'));
    }

    /**
     * Store a newly created service provider
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'category_id' => 'required|exists:categories,id',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['name', 'category_id', 'phone', 'address', 'description']);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('service-providers', 'public');
            $data['photo'] = $photoPath;
        }

        ServiceProvider::create($data);

        return redirect()
            ->route('service-providers.index')
            ->with('success', 'Service Provider berhasil ditambahkan');
    }

    /**
     * Display the specified service provider
     */
    public function show($uuid)
    {
        $provider = ServiceProvider::with('category')->where('uuid', $uuid)->firstOrFail();
        return view('service-providers.show', compact('provider'));
    }

    /**
     * Show the form for editing the specified service provider
     */
    public function edit($uuid)
    {
        $provider = ServiceProvider::where('uuid', $uuid)->firstOrFail();
        $categories = Category::all();
        return view('service-providers.edit', compact('provider', 'categories'));
    }

    /**
     * Update the specified service provider
     */
    public function update(Request $request, $uuid)
    {
        $provider = ServiceProvider::where('uuid', $uuid)->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'category_id' => 'required|exists:categories,id',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['name', 'category_id', 'phone', 'address', 'description']);

        if ($request->hasFile('photo')) {
            if ($provider->photo && Storage::disk('public')->exists($provider->photo)) {
                Storage::disk('public')->delete($provider->photo);
            }
            $photoPath = $request->file('photo')->store('service-providers', 'public');
            $data['photo'] = $photoPath;
        }

        $provider->update($data);

        return redirect()
            ->route('service-providers.index')
            ->with('success', 'Service Provider berhasil diperbarui');
    }

    /**
     * Remove the specified service provider
     */
    public function destroy($uuid)
    {
        $provider = ServiceProvider::where('uuid', $uuid)->firstOrFail();

        if ($provider->photo && Storage::disk('public')->exists($provider->photo)) {
            Storage::disk('public')->delete($provider->photo);
        }

        $provider->delete();

        return redirect()
            ->route('service-providers.index')
            ->with('success', 'Service Provider berhasil dihapus');
    }
}
