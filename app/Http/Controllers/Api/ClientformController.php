<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Clientform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientformController extends Controller
{
    public function index()
    {
        $clients = Clientform::paginate(10);

        return response()->json([
            'status' => true,
            'data' => $clients,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:100',
            'website' => 'nullable|url|max:255',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:20',
            'location' => 'required|string|max:100',
            'company_logo' => 'nullable|file|mimes:jpg,jpeg,png,svg|max:5120',
            'gst_number' => 'required|string|max:50',
            'sla_document' => 'nullable|file|mimes:pdf,doc,docx,jpeg,jpg,png|max:5120',
            'contact_name' => 'required|string|max:100',
            'designation' => 'required|string|max:100',
            'contact_email' => 'required|email|max:100',
            'contact_phone' => 'required|string|max:20',
        ]);

        // Custom website validation - removed the www requirement to match frontend
        $validator->after(function ($validator) use ($request) {
            if ($request->filled('website')) {
                $website = $request->website;
                // Just validate it's a proper URL format
                if (!filter_var($website, FILTER_VALIDATE_URL)) {
                    $validator->errors()->add('website', 'Please enter a valid website URL.');
                }
            }
        });

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Get all data except files
        $data = $request->except(['company_logo', 'sla_document']);

        // Handle file uploads
        if ($request->hasFile('company_logo')) {
            $logoFile = $request->file('company_logo');
            if ($logoFile->isValid()) {
                $data['company_logo'] = $logoFile->store('logos', 'public');
            }
        }

        if ($request->hasFile('sla_document')) {
            $slaFile = $request->file('sla_document');
            if ($slaFile->isValid()) {
                $data['sla_document'] = $slaFile->store('documents', 'public');
            }
        }

        $client = Clientform::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Client created successfully',
            'data' => $client
        ], 201);
    }

    public function show($id)
    {
        $client = Clientform::find($id);

        if (!$client) {
            return response()->json([
                'status' => false,
                'message' => 'Client not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $client
        ]);
    }

    public function update(Request $request, $id)
    {
        $client = Clientform::find($id);

        if (!$client) {
            return response()->json([
                'status' => false,
                'message' => 'Client not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'company_name' => 'sometimes|string|max:100',
            'website' => 'nullable|url|max:255',
            'email' => 'sometimes|email|max:100',
            'phone' => 'sometimes|string|max:20',
            'location' => 'sometimes|string|max:100',
            'company_logo' => 'nullable|file|mimes:jpeg,jpg,png,svg|max:5120',
            'gst_number' => 'sometimes|string|max:50',
            'sla_document' => 'nullable|file|mimes:pdf,doc,docx,jpeg,jpg,png|max:5120',
            'contact_name' => 'sometimes|string|max:100',
            'designation' => 'sometimes|string|max:100',
            'contact_email' => 'sometimes|email|max:100',
            'contact_phone' => 'sometimes|string|max:20',
        ]);

        // Custom website validation
        $validator->after(function ($validator) use ($request) {
            if ($request->filled('website')) {
                $website = $request->website;
                if (!filter_var($website, FILTER_VALIDATE_URL)) {
                    $validator->errors()->add('website', 'Please enter a valid website URL.');
                }
            }
        });

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->except(['company_logo', 'sla_document']);

        if ($request->hasFile('company_logo')) {
            $logoFile = $request->file('company_logo');
            if ($logoFile->isValid()) {
                $data['company_logo'] = $logoFile->store('logos', 'public');
            }
        }

        if ($request->hasFile('sla_document')) {
            $slaFile = $request->file('sla_document');
            if ($slaFile->isValid()) {
                $data['sla_document'] = $slaFile->store('documents', 'public');
            }
        }

        $client->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Client updated successfully',
            'data' => $client
        ]);
    }

    public function destroy($id)
    {
        $client = Clientform::find($id);

        if (!$client) {
            return response()->json([
                'status' => false,
                'message' => 'Client not found'
            ], 404);
        }

        $client->delete();

        return response()->json([
            'status' => true,
            'message' => 'Client deleted successfully'
        ]);
    }
}