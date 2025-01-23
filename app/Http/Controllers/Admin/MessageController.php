<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        // Fetch all messages
        $messages = Message::latest()->get();

        // Return the admin messages view
        return view('admin.messages.index', compact('messages'));
    }

    public function show($id)
    {
        $message = Message::find($id);

        if (!$message) {
            return response()->json(['success' => false, 'message' => 'Message not found!'], 404);
        }

        return response()->json(['success' => true, 'message' => $message], 200);
    }
}
