<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FlightEnquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FlightEnquiryController extends Controller
{
    /**
     * Display a listing of flight enquiries.
     */
    public function index()
    {
        // Both admin and subadmin can access
        if (!Auth::check() || !Auth::user()->isAdminOrSubAdmin()) {
            abort(403, 'You do not have permission to access this area.');
        }
        
        return view('admin.flight-enquiries.index');
    }

    /**
     * Get all flight enquiries (API endpoint for Axios)
     */
    public function getFlightEnquiries(Request $request)
    {
        try {
            // Both admin and subadmin can access
            if (!Auth::check() || !Auth::user()->isAdminOrSubAdmin()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You do not have permission to access this area.'
                ], 403);
            }
            
            $perPage = $request->get('per_page', 15);
            
            // Build query with filters
            $query = FlightEnquiry::select('id', 'trip_type', 'from_city', 'to_city', 'departure_date', 'return_date', 'adults', 'children', 'infants', 'contact_number', 'email', 'ip_address', 'user_agent', 'created_at');
            
            // Apply filters
            if ($request->has('filter_email') && $request->filter_email) {
                $query->where('email', 'like', '%' . $request->filter_email . '%');
            }
            
            if ($request->has('filter_from_city') && $request->filter_from_city) {
                $query->where('from_city', 'like', '%' . $request->filter_from_city . '%');
            }
            
            if ($request->has('filter_to_city') && $request->filter_to_city) {
                $query->where('to_city', 'like', '%' . $request->filter_to_city . '%');
            }
            
            if ($request->has('filter_trip_type') && $request->filter_trip_type) {
                $query->where('trip_type', $request->filter_trip_type);
            }
            
            $enquiries = $query->orderBy('created_at', 'desc')->paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => $enquiries->items(),
                'pagination' => [
                    'current_page' => $enquiries->currentPage(),
                    'last_page' => $enquiries->lastPage(),
                    'per_page' => $enquiries->perPage(),
                    'total' => $enquiries->total(),
                    'from' => $enquiries->firstItem(),
                    'to' => $enquiries->lastItem(),
                ],
                'links' => [
                    'first' => $enquiries->url(1),
                    'last' => $enquiries->url($enquiries->lastPage()),
                    'prev' => $enquiries->previousPageUrl(),
                    'next' => $enquiries->nextPageUrl(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading flight enquiries: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get a single flight enquiry (API endpoint for Axios)
     */
    public function show($id)
    {
        try {
            if (!Auth::check() || !Auth::user()->isAdminOrSubAdmin()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You do not have permission to access this area.'
                ], 403);
            }

            $enquiry = FlightEnquiry::find($id);

            if (!$enquiry) {
                return response()->json([
                    'success' => false,
                    'message' => 'Flight enquiry not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $enquiry
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading flight enquiry: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified flight enquiry.
     */
    public function destroy($id)
    {
        try {
            if (!Auth::check() || !Auth::user()->isAdminOrSubAdmin()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You do not have permission to access this area.'
                ], 403);
            }

            $enquiry = FlightEnquiry::find($id);

            if (!$enquiry) {
                return response()->json([
                    'success' => false,
                    'message' => 'Flight enquiry not found'
                ], 404);
            }

            $enquiry->delete();

            return response()->json([
                'success' => true,
                'message' => 'Flight enquiry deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting flight enquiry: ' . $e->getMessage()
            ], 500);
        }
    }
}

