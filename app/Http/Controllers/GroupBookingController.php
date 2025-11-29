<?php

namespace App\Http\Controllers;

use App\Mail\GroupBookingAdminMail;
use App\Mail\GroupBookingUserMail;
use App\Models\GroupBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

class GroupBookingController extends Controller
{
    /**
     * Display the group booking page
     */
    public function index()
    {
        return view('group-booking.index');
    }

    /**
     * Handle group booking form submission (Axios JSON).
     */
    public function submit(Request $request)
    {
        // Limit to 5 group booking requests per 24 hours from the same IP
        $ip = $request->ip();
        $recentCount = GroupBooking::where('ip_address', $ip)
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->count();

        if ($recentCount >= 5) {
            $oldestRequest = GroupBooking::where('ip_address', $ip)
                ->where('created_at', '>=', Carbon::now()->subDay())
                ->orderBy('created_at', 'asc')
                ->first();
            
            $retryAfter = null;
            if ($oldestRequest) {
                $retryAfter = $oldestRequest->created_at->copy()->addDay()->diffForHumans();
            }

            return response()->json([
                'message' => 'You have reached the limit of 5 group booking requests in 24 hours. Please try again later.',
                'retry_after' => $retryAfter,
                'limit' => 5,
                'used' => $recentCount,
            ], 429);
        }

        $validated = $request->validate([
            'from_city' => ['required', 'string', 'max:255'],
            'to_city' => ['required', 'string', 'max:255'],
            'departure_date' => ['required', 'date', 'after_or_equal:today'],
            'return_date' => ['nullable', 'date', 'after_or_equal:departure_date'],
            'passengers' => ['required', 'string', 'in:10-20,21-30,31-50,51-100,100+'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'organization' => ['nullable', 'string', 'max:255'],
            'requirements' => ['nullable', 'string', 'max:2000'],
        ]);

        // Store booking in database
        GroupBooking::create([
            'from_city' => $validated['from_city'],
            'to_city' => $validated['to_city'],
            'departure_date' => $validated['departure_date'],
            'return_date' => $validated['return_date'] ?? null,
            'passengers' => $validated['passengers'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'organization' => $validated['organization'] ?? null,
            'requirements' => $validated['requirements'] ?? null,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Get remaining requests count
        $remainingCount = 5 - ($recentCount + 1);

        $adminEmail = config('site.contact.admin_email', config('site.contact.email', 'Groups@AirRj.com'));

        // Send email to admin
        Mail::to($adminEmail)->send(new GroupBookingAdminMail($validated));

        // Confirmation email to user
        Mail::to($validated['email'])->send(new GroupBookingUserMail($validated));

        return response()->json([
            'message' => 'Thank you for your group booking request. We will contact you shortly with the best group fare quotes.',
            'remaining_requests' => $remainingCount,
            'limit' => 5,
        ]);
    }
}

