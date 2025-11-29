<?php

namespace App\Http\Controllers;

use App\Mail\ContactAdminMail;
use App\Mail\ContactUserMail;
use App\Models\ContactEnquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    /**
     * Handle contact form submission (Axios JSON).
     */
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        // Limit to 2 contact enquiries per 24 hours from the same IP
        $ip = $request->ip();
        $recentCount = ContactEnquiry::where('ip_address', $ip)
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->count();

        if ($recentCount >= 2) {
            return response()->json([
                'message' => 'You have reached the limit of 2 contact requests in 24 hours from this IP address. Please try again later.',
            ], 429);
        }

        // Store enquiry in database
        ContactEnquiry::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        $adminEmail = config('site.contact.admin_email', config('site.contact.email'));

        // Send email to admin
        Mail::to($adminEmail)->send(new ContactAdminMail($validated));

        // Confirmation email to user
        Mail::to($validated['email'])->send(new ContactUserMail($validated));

        return response()->json([
            'message' => 'Thank you for contacting us. We have received your message.',
        ]);
    }
}

