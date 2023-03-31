<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function store(Request $request){

        $request->validate([
            'violation_type' => 'required|in:communication,name,threat',
        ]);

        Report::create([
            'reporter_id'    => Auth::id(),
            'source_id'      => $request->source_id,
            'source'         => $request->source,
            'violation_type' => $request->violation_type,
        ]);

        return redirect()->back();
    }
}
