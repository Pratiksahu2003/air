<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AirlineController extends Controller
{
    /**
     * Display a listing of airlines.
     */
    public function index()
    {
        // Only admins can access airline management
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Only admins can access airline management');
        }
        
        return view('admin.airlines.index');
    }

    /**
     * Get all airlines (API endpoint for Axios)
     */
    public function getAirlines(Request $request)
    {
        try {
            // Only admins can access airline management
            if (!Auth::check() || !Auth::user()->isAdmin()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Only admins can access airline management'
                ], 403);
            }
            
            $perPage = $request->get('per_page', 15); // Default 15 items per page
            
            // Build query with filters
            $query = Airline::select('id', 'code', 'name', 'slug', 'logo', 'country', 'login_id', 'created_at', 'updated_at');
            
            // Apply filters
            if ($request->has('filter_name') && $request->filter_name) {
                $query->where('name', 'like', '%' . $request->filter_name . '%');
            }
            
            if ($request->has('filter_code') && $request->filter_code) {
                $query->where('code', 'like', '%' . strtoupper($request->filter_code) . '%');
            }
            
            if ($request->has('filter_country') && $request->filter_country) {
                $query->where('country', 'like', '%' . $request->filter_country . '%');
            }
            
            // Order by created_at or id
            $airlines = $query->orderBy('id', 'desc')->paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => $airlines->items(),
                'pagination' => [
                    'current_page' => $airlines->currentPage(),
                    'last_page' => $airlines->lastPage(),
                    'per_page' => $airlines->perPage(),
                    'total' => $airlines->total(),
                    'from' => $airlines->firstItem(),
                    'to' => $airlines->lastItem(),
                ],
                'links' => [
                    'first' => $airlines->url(1),
                    'last' => $airlines->url($airlines->lastPage()),
                    'prev' => $airlines->previousPageUrl(),
                    'next' => $airlines->nextPageUrl(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading airlines: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created airline.
     */
    public function store(Request $request)
    {
        try {
            if (!Auth::check() || !Auth::user()->isAdmin()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Only admins can access airline management'
                ], 403);
            }

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'code' => 'required|string|max:10|unique:airlines,code',
                'slug' => 'nullable|string|max:255|unique:airlines,slug',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'logo_url' => 'nullable|string|max:500',
                'country' => 'required|string|max:255',
                'login_id' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            // Generate slug if not provided
            $slug = $request->slug;
            if (empty($slug)) {
                $slug = Str::slug($request->name);
                // Ensure uniqueness
                $originalSlug = $slug;
                $counter = 1;
                while (Airline::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
            } else {
                // Check if slug is unique
                if (Airline::where('slug', $slug)->exists()) {
                    return response()->json([
                        'success' => false,
                        'errors' => ['slug' => ['The slug has already been taken.']]
                    ], 422);
                }
            }

            // Handle logo upload
            $logoPath = null;
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $logoName = time() . '_' . Str::slug($request->name) . '.' . $logo->getClientOriginalExtension();
                $logoPath = $logo->storeAs('airlines', $logoName, 'public');
                $logoPath = '/storage/' . $logoPath;
            } elseif ($request->has('logo_url') && !empty($request->logo_url)) {
                $logoPath = $request->logo_url;
            }

            $airline = Airline::create([
                'name' => $request->name,
                'code' => strtoupper($request->code),
                'slug' => $slug,
                'logo' => $logoPath,
                'country' => $request->country,
                'login_id' => $request->login_id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Airline created successfully!',
                'data' => $airline
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating airline: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get a single airline (API endpoint for Axios)
     */
    public function show($id)
    {
        try {
            if (!Auth::check() || !Auth::user()->isAdmin()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Only admins can access airline management'
                ], 403);
            }

            $airline = Airline::find($id);

            if (!$airline) {
                return response()->json([
                    'success' => false,
                    'message' => 'Airline not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $airline
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading airline: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified airline.
     */
    public function update(Request $request, $id)
    {
        try {
            if (!Auth::check() || !Auth::user()->isAdmin()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Only admins can access airline management'
                ], 403);
            }

            $airline = Airline::find($id);

            if (!$airline) {
                return response()->json([
                    'success' => false,
                    'message' => 'Airline not found'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'code' => 'required|string|max:10|unique:airlines,code,' . $id,
                'slug' => 'nullable|string|max:255|unique:airlines,slug,' . $id,
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'logo_url' => 'nullable|string|max:500',
                'country' => 'required|string|max:255',
                'login_id' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            // Generate slug if not provided
            $slug = $request->slug;
            if (empty($slug)) {
                $slug = Str::slug($request->name);
                // Ensure uniqueness (excluding current airline)
                $originalSlug = $slug;
                $counter = 1;
                while (Airline::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                    $slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
            } else {
                // Check if slug is unique (excluding current airline)
                if (Airline::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                    return response()->json([
                        'success' => false,
                        'errors' => ['slug' => ['The slug has already been taken.']]
                    ], 422);
                }
            }

            // Handle logo upload
            if ($request->hasFile('logo')) {
                // Delete old logo if it exists and is a stored file
                if ($airline->logo && strpos($airline->logo, '/storage/airlines/') !== false) {
                    $oldLogoPath = str_replace('/storage/', '', $airline->logo);
                    if (Storage::disk('public')->exists($oldLogoPath)) {
                        Storage::disk('public')->delete($oldLogoPath);
                    }
                }
                
                $logo = $request->file('logo');
                $logoName = time() . '_' . Str::slug($request->name) . '.' . $logo->getClientOriginalExtension();
                $logoPath = $logo->storeAs('airlines', $logoName, 'public');
                $airline->logo = '/storage/' . $logoPath;
            } elseif ($request->has('logo_url') && !empty($request->logo_url)) {
                // Only update logo if logo_url is provided and no file is uploaded
                if (!$request->hasFile('logo')) {
                    $airline->logo = $request->logo_url;
                }
            }

            $airline->name = $request->name;
            $airline->code = strtoupper($request->code);
            $airline->slug = $slug;
            $airline->country = $request->country;
            $airline->login_id = $request->login_id;

            $airline->save();

            return response()->json([
                'success' => true,
                'message' => 'Airline updated successfully!',
                'data' => $airline
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating airline: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified airline.
     */
    public function destroy($id)
    {
        try {
            if (!Auth::check() || !Auth::user()->isAdmin()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Only admins can access airline management'
                ], 403);
            }

            $airline = Airline::find($id);

            if (!$airline) {
                return response()->json([
                    'success' => false,
                    'message' => 'Airline not found'
                ], 404);
            }

            // Delete logo file if it exists
            if ($airline->logo && strpos($airline->logo, '/storage/airlines/') !== false) {
                $logoPath = str_replace('/storage/', '', $airline->logo);
                if (Storage::disk('public')->exists($logoPath)) {
                    Storage::disk('public')->delete($logoPath);
                }
            }

            $airline->delete();

            return response()->json([
                'success' => true,
                'message' => 'Airline deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting airline: ' . $e->getMessage()
            ], 500);
        }
    }
}

