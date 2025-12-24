<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ServiceProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /api/service-providers
     * Query params: limit, page, search, orderBy, sortBy, category_id
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'limit' => 'integer|min:1|max:100',
                'page' => 'integer|min:1',
                'search' => 'string|max:255',
                'orderBy' => 'string|in:id,name,created_at,updated_at',
                'sortBy' => 'string|in:asc,desc',
                'category_id' => 'integer|min:1'
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $limit = $request->get('limit', 10);
            $page = $request->get('page', 1);
            $search = $request->get('search', '');
            $orderBy = $request->get('orderBy', 'id');
            $sortBy = $request->get('sortBy', 'asc');
            $categoryId = $request->get('category_id');

            $query = ServiceProvider::with('category');

            // Search functionality
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%')
                      ->orWhere('address', 'like', '%' . $search . '%');
                });
            }

            // Category filter
            if ($categoryId) {
                $query->where('category_id', $categoryId);
            }

            // Ordering
            $query->orderBy($orderBy, $sortBy);

            // Get total count
            $total = $query->count();

            // Pagination
            $providers = $query->skip(($page - 1) * $limit)
                               ->take($limit)
                               ->get();

            $totalPages = ceil($total / $limit);

            return response()->json([
                'success' => true,
                'message' => 'Service providers retrieved successfully',
                'data' => [
                    'providers' => $providers,
                    'pagination' => [
                        'current_page' => (int)$page,
                        'total_pages' => $totalPages,
                        'per_page' => (int)$limit,
                        'total_items' => $total,
                        'has_next_page' => $page < $totalPages,
                        'has_prev_page' => $page > 1,
                    ]
                ]
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     * POST /api/service-providers
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'category_id' => 'required|integer|exists:categories,id',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string',
                'description' => 'nullable|string',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $data = $request->only(['name', 'category_id', 'phone', 'address', 'description']);

            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('service-providers', 'public');
                $data['photo'] = $photoPath;
            }

            $provider = ServiceProvider::create($data);
            $provider->load('category');

            return response()->json([
                'success' => true,
                'message' => 'Service provider created successfully',
                'data' => $provider
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     * GET /api/service-providers/{id}
     */
    public function show(string $id): JsonResponse
    {
        try {
            $provider = ServiceProvider::with('category')->find($id);

            if (!$provider) {
                return response()->json([
                    'success' => false,
                    'message' => 'Service provider not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Service provider retrieved successfully',
                'data' => $provider
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     * PUT /api/service-providers/{id}
     */
    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $provider = ServiceProvider::find($id);

            if (!$provider) {
                return response()->json([
                    'success' => false,
                    'message' => 'Service provider not found'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'name' => 'sometimes|string|max:100',
                'category_id' => 'sometimes|integer|exists:categories,id',
                'phone' => 'sometimes|string|max:20',
                'address' => 'sometimes|string',
                'description' => 'sometimes|string',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $data = $request->only(['name', 'category_id', 'phone', 'address', 'description']);

            if ($request->hasFile('photo')) {
                if ($provider->photo && Storage::disk('public')->exists($provider->photo)) {
                    Storage::disk('public')->delete($provider->photo);
                }
                $photoPath = $request->file('photo')->store('service-providers', 'public');
                $data['photo'] = $photoPath;
            }

            $provider->update($data);
            $provider->load('category');

            return response()->json([
                'success' => true,
                'message' => 'Service provider updated successfully',
                'data' => $provider
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /api/service-providers/{id}
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $provider = ServiceProvider::find($id);

            if (!$provider) {
                return response()->json([
                    'success' => false,
                    'message' => 'Service provider not found'
                ], 404);
            }

            if ($provider->photo && Storage::disk('public')->exists($provider->photo)) {
                Storage::disk('public')->delete($provider->photo);
            }

            $provider->delete();

            return response()->json([
                'success' => true,
                'message' => 'Service provider deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
