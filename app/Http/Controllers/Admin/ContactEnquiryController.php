<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactEnquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactEnquiryController extends Controller
{
    /**
     * Display a listing of contact enquiries.
     */
    public function index()
    {
        // Both admin and subadmin can access
        if (!Auth::check() || !Auth::user()->isAdminOrSubAdmin()) {
            abort(403, 'You do not have permission to access this area.');
        }
        
        return view('admin.contact-enquiries.index');
    }

    /**
     * Get all contact enquiries (API endpoint for Axios)
     */
    public function getContactEnquiries(Request $request)
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
            $query = ContactEnquiry::select('id', 'name', 'email', 'phone', 'subject', 'message', 'ip_address', 'user_agent', 'created_at');
            
            // Apply filters
            if ($request->has('filter_name') && $request->filter_name) {
                $query->where('name', 'like', '%' . $request->filter_name . '%');
            }
            
            if ($request->has('filter_email') && $request->filter_email) {
                $query->where('email', 'like', '%' . $request->filter_email . '%');
            }
            
            if ($request->has('filter_subject') && $request->filter_subject) {
                $query->where('subject', 'like', '%' . $request->filter_subject . '%');
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
                'message' => 'Error loading contact enquiries: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get a single contact enquiry (API endpoint for Axios)
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

            $enquiry = ContactEnquiry::find($id);

            if (!$enquiry) {
                return response()->json([
                    'success' => false,
                    'message' => 'Contact enquiry not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $enquiry
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading contact enquiry: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified contact enquiry.
     */
    public function destroy($id)
    {
        try {
            if (!Auth::check() || !Auth::user()->isAdmin()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Only admins can delete contact enquiries'
                ], 403);
            }

            $enquiry = ContactEnquiry::find($id);

            if (!$enquiry) {
                return response()->json([
                    'success' => false,
                    'message' => 'Contact enquiry not found'
                ], 404);
            }

            $enquiry->delete();

            return response()->json([
                'success' => true,
                'message' => 'Contact enquiry deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting contact enquiry: ' . $e->getMessage()
            ], 500);
        }
    }
}

