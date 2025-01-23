<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class UserMessageController extends Controller
{
    /**
     * Store a new message.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'message' => 'required|string|min:5|max:2000',
        ]);

        // Rate limiting
        if (Message::where('email', $request->email)->where('created_at', '>=', now()->subMinute())->exists()) {
            return redirect()->back()->withErrors(['message' => 'You can only send one message per minute.']);
        }

        try {
            // Create the message
            Message::create($validated);

            // Log the message
            \Log::info('New message received', [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'message' => $validated['message'],
                'ip' => $request->ip(),
            ]);

            return redirect()->back()->with('success', 'Message sent successfully.');
        } catch (\Exception $e) {
            \Log::error('Error creating message: ' . $e->getMessage());
            return redirect()->back()->withErrors(['message' => 'An error occurred. Please try again later.']);
        }
    }
}

