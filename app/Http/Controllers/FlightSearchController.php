<?php

namespace App\Http\Controllers;

use App\Mail\FlightAdminMail;
use App\Mail\FlightUserMail;
use App\Models\FlightEnquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

class FlightSearchController extends Controller
{
    /**
     * Handle flight search form submission (Axios JSON).
     */
    public function submit(Request $request)
    {
        // Limit to 5 flight enquiries per 24 hours from the same IP
        // Check rate limit BEFORE validation to save resources
        $ip = $request->ip();
        $recentCount = FlightEnquiry::where('ip_address', $ip)
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->count();

        if ($recentCount >= 5) {
            // Get the oldest request to calculate when they can submit again
            $oldestRequest = FlightEnquiry::where('ip_address', $ip)
                ->where('created_at', '>=', Carbon::now()->subDay())
                ->orderBy('created_at', 'asc')
                ->first();
            
            $retryAfter = null;
            if ($oldestRequest) {
                // Clone to avoid modifying the original instance
                $retryAfter = $oldestRequest->created_at->copy()->addDay()->diffForHumans();
            }

            return response()->json([
                'message' => 'You have reached the limit of 5 flight search requests in 24 hours. Please try again later.',
                'retry_after' => $retryAfter,
                'limit' => 5,
                'used' => $recentCount,
            ], 429);
        }

        $validated = $request->validate([
            'trip_type' => ['required', 'string', 'in:oneway,roundtrip'],
            'from_city' => ['required', 'string', 'max:255'],
            'to_city' => ['required', 'string', 'max:255'],
            'departure_date' => ['required', 'date', 'after_or_equal:today'],
            'return_date' => ['nullable', 'date', 'after_or_equal:departure_date', 'required_if:trip_type,roundtrip'],
            'adults' => ['required', 'integer', 'min:1', 'max:50'],
            'children' => ['required', 'integer', 'min:0', 'max:50'],
            'infants' => ['required', 'integer', 'min:0', 'max:50'],
            'contact_number' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:255'],
        ]);

        // Store enquiry in database
        FlightEnquiry::create([
            'trip_type' => $validated['trip_type'],
            'from_city' => $validated['from_city'],
            'to_city' => $validated['to_city'],
            'departure_date' => $validated['departure_date'],
            'return_date' => $validated['return_date'] ?? null,
            'adults' => $validated['adults'],
            'children' => $validated['children'],
            'infants' => $validated['infants'],
            'contact_number' => $validated['contact_number'],
            'email' => $validated['email'],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Get remaining requests count
        $remainingCount = 5 - ($recentCount + 1);

        $adminEmail = config('site.contact.admin_email', config('site.contact.email', 'Groups@AirRj.com'));

        // Send email to admin
        Mail::to($adminEmail)->send(new FlightAdminMail($validated));

        // Confirmation email to user
        Mail::to($validated['email'])->send(new FlightUserMail($validated));

        return response()->json([
            'message' => 'Thank you for your flight search request. We will contact you shortly with the best flight options.',
            'remaining_requests' => $remainingCount,
            'limit' => 5,
        ]);
    }
}
