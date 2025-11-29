<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GroupBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GroupBookingController extends Controller
{
    /**
     * Display a listing of group bookings.
     */
    public function index()
    {
        // Both admin and subadmin can access
        if (!Auth::check() || !Auth::user()->isAdminOrSubAdmin()) {
            abort(403, 'You do not have permission to access this area.');
        }
        
        return view('admin.group-bookings.index');
    }

    /**
     * Get all group bookings (API endpoint for Axios)
     */
    public function getGroupBookings(Request $request)
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
            $query = GroupBooking::select('id', 'from_city', 'to_city', 'departure_date', 'return_date', 'passengers', 'name', 'email', 'phone', 'organization', 'requirements', 'ip_address', 'user_agent', 'created_at');
            
            // Apply filters
            if ($request->has('filter_name') && $request->filter_name) {
                $query->where('name', 'like', '%' . $request->filter_name . '%');
            }
            
            if ($request->has('filter_email') && $request->filter_email) {
                $query->where('email', 'like', '%' . $request->filter_email . '%');
            }
            
            if ($request->has('filter_organization') && $request->filter_organization) {
                $query->where('organization', 'like', '%' . $request->filter_organization . '%');
            }
            
            if ($request->has('filter_from_city') && $request->filter_from_city) {
                $query->where('from_city', 'like', '%' . $request->filter_from_city . '%');
            }
            
            if ($request->has('filter_to_city') && $request->filter_to_city) {
                $query->where('to_city', 'like', '%' . $request->filter_to_city . '%');
            }
            
            $bookings = $query->orderBy('created_at', 'desc')->paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => $bookings->items(),
                'pagination' => [
                    'current_page' => $bookings->currentPage(),
                    'last_page' => $bookings->lastPage(),
                    'per_page' => $bookings->perPage(),
                    'total' => $bookings->total(),
                    'from' => $bookings->firstItem(),
                    'to' => $bookings->lastItem(),
                ],
                'links' => [
                    'first' => $bookings->url(1),
                    'last' => $bookings->url($bookings->lastPage()),
                    'prev' => $bookings->previousPageUrl(),
                    'next' => $bookings->nextPageUrl(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading group bookings: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get a single group booking (API endpoint for Axios)
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

            $booking = GroupBooking::find($id);

            if (!$booking) {
                return response()->json([
                    'success' => false,
                    'message' => 'Group booking not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $booking
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading group booking: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified group booking.
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

            $booking = GroupBooking::find($id);

            if (!$booking) {
                return response()->json([
                    'success' => false,
                    'message' => 'Group booking not found'
                ], 404);
            }

            $booking->delete();

            return response()->json([
                'success' => true,
                'message' => 'Group booking deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting group booking: ' . $e->getMessage()
            ], 500);
        }
    }
}

