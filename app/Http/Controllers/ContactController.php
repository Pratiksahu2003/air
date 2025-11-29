<?php

namespace App\Http\Controllers;

use App\Mail\ContactAdminMail;
use App\Mail\ContactUserMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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


