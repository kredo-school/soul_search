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
        Contact::create([
            'message' => $request->message,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back();
    }
}
