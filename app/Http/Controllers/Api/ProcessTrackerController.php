<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller; // ✅ This is required
use Illuminate\Http\Request;
use App\Models\ProcessTracker;

class ProcessTrackerController extends Controller
{
public function store(Request $request)
{
    $validated = $request->validate([
        'candidate_id' => 'required|exists:candidates,candidate_id', // ✅ corrected
        'screening' => 'nullable|string|max:50',
        'hr_interview' => 'nullable|string|max:50',
        'client_cv_review' => 'nullable|string|max:50',
        'client_interview' => 'nullable|string|max:50',
        'offer_letter' => 'nullable|string|max:50',
    ]);

    $tracker = ProcessTracker::create($validated);

    return response()->json([
        'message' => 'Process tracker created successfully.',
        'data' => $tracker
    ], 201);
}

}
