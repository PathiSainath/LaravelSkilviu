<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    /**
     * Get all candidates with related job info.
     */
    public function index()
    {
        $candidates = Candidate::with('recruitment')->get();

        return response()->json($candidates);
    }

    /**
     * Get a single candidate by ID.
     */
    public function show($id)
    {
        $candidate = Candidate::with('recruitment')->findOrFail($id);

        return response()->json($candidate);
    }

    /**
     * Store a new candidate application.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_id' => 'required|exists:recruitment,job_id',
            'candidate_name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'mobile_number' => 'required|string|max:20',
            'current_company' => 'nullable|string|max:100',
            'years_experience' => 'nullable|numeric|between:0,50',
            'relevant_experience' => 'nullable|numeric|between:0,50',
            'current_ctc' => 'nullable|string|max:20',
            'expected_ctc' => 'nullable|string|max:20',
            'notice_period' => 'nullable|string|max:50',
            'current_location' => 'required|string|max:100',
            'preferred_location' => 'nullable|string|max:100',
            'available_for_interview' => 'nullable|date',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'remarks' => 'nullable|string',
            'preferred_company' => 'nullable|string|max:100',
        ]);

        // Handle resume upload
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
            $validated['resume_path'] = $resumePath;
        }

        // Remove 'resume' before saving to DB
        unset($validated['resume']);

        // Default status on creation
        $validated['status'] = 'Applied';

        $candidate = Candidate::create($validated);

        return response()->json([
            'message' => 'Candidate submitted successfully',
            'data' => $candidate
        ], 201);
    }

    /**
     * Update candidate status and remarks.
     */
    public function update(Request $request, $id)
    {
        $candidate = Candidate::findOrFail($id);

        $validated = $request->validate([
            'status' => 'nullable|string|max:50',
            'remarks' => 'nullable|string',
        ]);

        $candidate->update($validated);

        return response()->json([
            'message' => 'Candidate updated successfully',
            'data' => $candidate
        ]);
    }

    /**
     * Delete a candidate.
     */
    public function destroy($id)
    {
        $candidate = Candidate::findOrFail($id);
        $candidate->delete();

        return response()->json(['message' => 'Candidate deleted successfully']);
    }
}
