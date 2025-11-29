<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airpot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AirportController extends Controller
{
    /**
     * Display a listing of airports.
     */
    public function index()
    {
        // Only admins can access airport management
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Only admins can access airport management');
        }
        
        return view('admin.airports.index');
    }

    /**
     * Get all airports (API endpoint for Axios)
     */
    public function getAirports(Request $request)
    {
        try {
            // Only admins can access airport management
            if (!Auth::check() || !Auth::user()->isAdmin()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Only admins can access airport management'
                ], 403);
            }
            
            $perPage = $request->get('per_page', 15); // Default 15 items per page
            
            // Build query with filters
            $query = Airpot::select('id', 'name', 'code', 'country', 'city', 'continents', 'type');
            
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
            
            if ($request->has('filter_city') && $request->filter_city) {
                $query->where('city', 'like', '%' . $request->filter_city . '%');
            }
            
            if ($request->has('filter_continent') && $request->filter_continent) {
                $query->where('continents', 'like', '%' . $request->filter_continent . '%');
            }
            
            if ($request->has('filter_type') && $request->filter_type !== '' && $request->filter_type !== null) {
                $query->where('type', (int)$request->filter_type);
            }
            
            // Order by id since created_at column doesn't exist in the table
            $airports = $query->orderBy('id', 'desc')->paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => $airports->items(),
                'pagination' => [
                    'current_page' => $airports->currentPage(),
                    'last_page' => $airports->lastPage(),
                    'per_page' => $airports->perPage(),
                    'total' => $airports->total(),
                    'from' => $airports->firstItem(),
                    'to' => $airports->lastItem(),
                ],
                'links' => [
                    'first' => $airports->url(1),
                    'last' => $airports->url($airports->lastPage()),
                    'prev' => $airports->previousPageUrl(),
                    'next' => $airports->nextPageUrl(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading airports: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created airport.
     */
    public function store(Request $request)
    {
        try {
            if (!Auth::check() || !Auth::user()->isAdmin()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Only admins can access airport management'
                ], 403);
            }

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'code' => 'required|string|max:10|unique:airports,code',
                'country' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'continents' => 'nullable|string|max:255',
                'type' => 'nullable|integer|in:0,1',
                'image' => 'nullable|string|max:255',
                'airport_txt' => 'nullable|string',
                'Address' => 'nullable|string|max:500',
                'Contact' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $airport = Airpot::create([
                'name' => $request->name,
                'code' => strtoupper($request->code),
                'country' => $request->country,
                'city' => $request->city,
                'continents' => $request->continents,
                'type' => $request->type !== null && $request->type !== '' ? (int)$request->type : null,
                'image' => $request->image,
                'airport_txt' => $request->airport_txt,
                'Address' => $request->Address,
                'Contact' => $request->Contact,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Airport created successfully!',
                'data' => $airport
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating airport: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get a single airport (API endpoint for Axios)
     */
    public function show($id)
    {
        try {
            if (!Auth::check() || !Auth::user()->isAdmin()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Only admins can access airport management'
                ], 403);
            }

            $airport = Airpot::find($id);

            if (!$airport) {
                return response()->json([
                    'success' => false,
                    'message' => 'Airport not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $airport
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading airport: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified airport.
     */
    public function update(Request $request, $id)
    {
        try {
            if (!Auth::check() || !Auth::user()->isAdmin()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Only admins can access airport management'
                ], 403);
            }

            $airport = Airpot::find($id);

            if (!$airport) {
                return response()->json([
                    'success' => false,
                    'message' => 'Airport not found'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'code' => 'required|string|max:10|unique:airports,code,' . $id,
                'country' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'continents' => 'nullable|string|max:255',
                'type' => 'nullable|integer|in:0,1',
                'image' => 'nullable|string|max:255',
                'airport_txt' => 'nullable|string',
                'Address' => 'nullable|string|max:500',
                'Contact' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $airport->name = $request->name;
            $airport->code = strtoupper($request->code);
            $airport->country = $request->country;
            $airport->city = $request->city;
            $airport->continents = $request->continents;
            $airport->type = $request->type !== null && $request->type !== '' ? (int)$request->type : null;
            $airport->image = $request->image;
            $airport->airport_txt = $request->airport_txt;
            $airport->Address = $request->Address;
            $airport->Contact = $request->Contact;

            $airport->save();

            return response()->json([
                'success' => true,
                'message' => 'Airport updated successfully!',
                'data' => $airport
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating airport: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified airport.
     */
    public function destroy($id)
    {
        try {
            if (!Auth::check() || !Auth::user()->isAdmin()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Only admins can access airport management'
                ], 403);
            }

            $airport = Airpot::find($id);

            if (!$airport) {
                return response()->json([
                    'success' => false,
                    'message' => 'Airport not found'
                ], 404);
            }

            $airport->delete();

            return response()->json([
                'success' => true,
                'message' => 'Airport deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting airport: ' . $e->getMessage()
            ], 500);
        }
    }
}

