<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use PHPOpenSourceSaver\JWTAuth\JWTGuard;

class AuthController extends Controller
{
    /**
     * Register a new user
     * POST /api/register
     */
    public function register(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            /** @var JWTGuard $auth */
            $auth = auth();
            $token = $auth->login($user);
            
            return response()->json([
                'success' => true,
                'message' => 'User registered successfully',
                'data' => [
                    'user' => $user,
                    'token' => $token,
                    'type' => 'bearer',
                    'expires_in' => $auth->factory()->getTTL() * 60
                ]
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
     * Login user and create token
     * POST /api/login
     */
    public function login(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $credentials = $request->only(['email', 'password']);

            /** @var JWTGuard $auth */
            $auth = auth();

            if (!$token = $auth->attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized',
                    'error' => 'Invalid email or password'
                ], 401);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'data' => [
                    'user' => $auth->user(),
                    'token' => $token,
                    'type' => 'bearer',
                    'expires_in' => $auth->factory()->getTTL() * 60
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
     * Get the authenticated user
     * GET /api/me
     */
    public function me(): JsonResponse
    {
        try {
            /** @var JWTGuard $auth */
            $auth = auth();
            
            return response()->json([
                'success' => true,
                'message' => 'User retrieved successfully',
                'data' => $auth->user()
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
     * Refresh a token
     * POST /api/refresh
     */
    public function refresh(): JsonResponse
    {
        try {
            /** @var JWTGuard $auth */
            $auth = auth();
            
            return response()->json([
                'success' => true,
                'message' => 'Token refreshed successfully',
                'data' => [
                    'user' => $auth->user(),
                    'token' => $auth->refresh(),
                    'type' => 'bearer',
                    'expires_in' => $auth->factory()->getTTL() * 60
                ]
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
     * Logout user (invalidate the token)
     * POST /api/logout
     */
    public function logout(): JsonResponse
    {
        try {
            /** @var JWTGuard $auth */
            $auth = auth();
            $auth->logout();

            return response()->json([
                'success' => true,
                'message' => 'User successfully logged out'
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
