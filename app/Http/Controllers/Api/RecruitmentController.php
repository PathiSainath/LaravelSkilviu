<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recruitment;
use Illuminate\Http\Request;

class RecruitmentController extends Controller
{
    /**
     * List all recruitment jobs
     */
    public function index()
    {
        // Return a clean array of recruitments without extra wrapping
        return response()->json(Recruitment::all(), 200);
    }

    /**
     * Store a new recruitment job
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id'             => 'required|exists:clientforms,id',
            'client_name'           => 'required|string|max:100',
            'job_title'             => 'required|string|max:100',
            'min_experience'        => 'nullable|integer',
            'max_experience'        => 'nullable|integer',
            'preferred_company'     => 'nullable|string|max:100',
            'type_of_industry'      => 'required|string|max:100',
            'notice_period'         => 'required|string|max:50',
            'benefit'               => 'required|string|max:100',
            'budget'                => 'required|string|max:50',
            'package'               => 'required|string|max:50',
            'qualification'         => 'required|string',
            'skills_required'       => 'required|string',
            'job_location'          => 'required|string|max:100',
            'timings'               => 'nullable|string|max:100',
            'no_of_positions'       => 'required|integer',
            'working_days'          => 'nullable|integer',
            'diversity_preference'  => 'nullable|string|max:50',
            'hiring_type'           => 'required|string|max:50',
            'work_mode'             => 'required|string|max:50',
            'interview_process'     => 'nullable|string',
            'key_responsibilities'  => 'required|string',
            'job_description'       => 'required|string',
            'jd_document_path'      => 'nullable|string|max:255',
        ]);

        $recruitment = Recruitment::create($validated);

        return response()->json([
            'message' => 'Recruitment created successfully',
            'data' => $recruitment
        ], 201);
    }

    /**
     * Show a single recruitment job
     */
    public function show($id)
    {
        $recruitment = Recruitment::findOrFail($id);

        return response()->json($recruitment, 200);
    }

    /**
     * Update an existing recruitment job
     */
    public function update(Request $request, $id)
    {
        $recruitment = Recruitment::findOrFail($id);
        $recruitment->update($request->all());

        return response()->json([
            'message' => 'Recruitment updated successfully',
            'data' => $recruitment
        ]);
    }

    /**
     * Delete a recruitment job
     */
    public function destroy($id)
    {
        Recruitment::destroy($id);

        return response()->json([
            'message' => 'Recruitment deleted successfully'
        ], 200);
    }
}
