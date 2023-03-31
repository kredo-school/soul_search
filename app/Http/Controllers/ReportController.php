<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function store(Request $request){

        $request->validate([
            'violation_type' => 'required',
        ]);

        Report::create([
            'reporter_id'    => Auth::id(),
            'source'         => $request->source,
            'source_id'      => $request->source_id,
            'violation_type' => $request->violation_type,
        ]);

        return redirect()->back();
    }
}
