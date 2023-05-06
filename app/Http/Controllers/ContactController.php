<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        return view('users.contacts.index');
    }

    public function store(Request $request)
    {
        $text = $request->message;
        Contact::create([
            'message' => $text,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()
            ->with('flash_message', 'Thank you for the message!')
            ->with('text', $text);
    }
}
