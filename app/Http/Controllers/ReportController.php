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

        // print $request->source;
        // print "<br>/";
        // print $request->source_id;
        // print "<br>//";
        // print $request->violation_type;

        Report::create([
            'reporter_id'    => Auth::id(),
            'source'         => $request->source,
            'source_id'      => $request->source_id,
            'violation_type' => $request->violation_type,
        ]);

        return redirect()->back();
    }
}
