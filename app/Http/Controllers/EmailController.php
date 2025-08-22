<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserThankYouMail;
use App\Mail\AdminNotificationMail;

class EmailController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'message' => 'nullable|string|max:500',
        ]);

        $userData = [
            'name'  => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ];

        try {
            // Send Thank You Email to User
            Mail::to($userData['email'])->send(new UserThankYouMail($userData));

            // Send Record Email to Admin
            Mail::to('saniya55singh@gmail.com')->send(new AdminNotificationMail($userData));

            return response()->json([
                'success' => true,
                'message' => 'Emails sent successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Email failed: ' . $e->getMessage()
            ], 500);
        }
    }
}
