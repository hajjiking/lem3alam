<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\KycDocument;
use Illuminate\Http\Request;

class KycController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $documents = KycDocument::where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'is_verified' => (bool) $user->is_verified,
                'verified_at' => $user->verified_at,
                'documents' => $documents,
            ],
        ]);
    }

    public function submit(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'type' => 'required|in:id_card,passport,driver_license,selfie,address_proof',
            'document' => 'required|file|max:5120|mimes:jpg,jpeg,png,pdf',
        ]);

        $path = $request->file('document')->store('kyc/'.$user->id, 'public');

        $doc = KycDocument::create([
            'user_id' => $user->id,
            'type' => $data['type'],
            'file_path' => $path,
            'status' => 'pending',
            'submitted_at' => now(),
        ]);

        AuditLog::create([
            'actor_id' => $user->id,
            'action' => 'kyc.submitted',
            'target_type' => 'kyc_document',
            'target_id' => $doc->id,
            'metadata' => [
                'type' => $doc->type,
                'file' => $doc->file_path,
            ],
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'KYC document submitted successfully.',
            'data' => [
                'document' => $doc,
                'file_url' => asset('storage/'.$path),
            ],
        ]);
    }
}
