<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Store a lead from any of the four forms (popup quiz + the three division pages).
     * Leads live in the admin dashboard; the APEX intake is for full onboarding submissions.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => ['nullable', 'string', 'max:120'],
            'email'    => ['required', 'email', 'max:160'],
            'phone'    => ['nullable', 'string', 'max:40'],
            'source'   => ['nullable', 'string', 'max:40'],
            'interest' => ['nullable', 'string', 'max:120'],
            'message'  => ['nullable', 'string', 'max:2000'],
            'profile'  => ['nullable', 'array'],
        ]);

        $lead = Lead::create($data);

        return response()->json([
            'ok'      => true,
            'message' => 'Thank you — our team will reach out shortly. Trust the Horse.',
            'id'      => $lead->id,
        ]);
    }
}
