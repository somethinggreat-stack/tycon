<?php

namespace App\Http\Controllers;

use App\Models\Onboarding;
use App\Services\ApexService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class OnboardingController extends Controller
{
    /** Public secure client onboarding form. */
    public function show()
    {
        return view('onboarding');
    }

    /** Confirmation page shown after a successful submission. */
    public function thanks()
    {
        // Only reachable right after a submission
        if (! session('onboarded')) {
            return redirect()->route('onboarding.show');
        }
        return view('onboarding-thanks');
    }

    /** Handle a secure onboarding submission. */
    public function store(Request $request)
    {
        // Fields align 1:1 with the APEX intake contract.
        $data = $request->validate([
            'first_name'         => ['required', 'string', 'max:80'],
            'middle_name'        => ['nullable', 'string', 'max:80'],
            'last_name'          => ['required', 'string', 'max:80'],
            'suffix'             => ['nullable', 'in:None,Jr.,Sr.,I,II,III,IV,V'],
            'email'              => ['required', 'email', 'max:160'],
            'phone'              => ['required', 'string', 'max:40'],
            'dob'                => ['required', 'date', 'before:today'],
            'ssn'                => ['required', 'string', 'max:20'],
            'street'             => ['required', 'string', 'max:160'],
            'apt'                => ['nullable', 'string', 'max:60'],
            'city'               => ['required', 'string', 'max:80'],
            'state'              => ['required', 'string', 'max:40'],
            'zip'                => ['required', 'string', 'max:12'],
            'cm_provider'        => ['required', 'string', 'max:80'],
            'cm_email'           => ['required', 'string', 'max:160'],
            'cm_password'        => ['required', 'string', 'max:120'],
            'cm_security_answer' => ['nullable', 'string', 'max:160'],
            'drivers_license'    => ['required', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:10240'],
            'proof_address'      => ['required', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:10240'],
            'ssn_card'           => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:10240'],
        ]);

        // Normalize "None" suffix to null
        if (($data['suffix'] ?? null) === 'None') {
            $data['suffix'] = null;
        }

        // Store documents privately (storage/app/private/onboarding)
        $data['dl_path']            = $this->storeDoc($request, 'drivers_license');
        $data['ssn_card_path']      = $this->storeDoc($request, 'ssn_card');
        $data['proof_address_path'] = $this->storeDoc($request, 'proof_address');

        unset($data['drivers_license'], $data['ssn_card'], $data['proof_address']);

        $client = Onboarding::create($data);

        // Forward the completed submission to the APEX Growth intake (New Clients).
        // The client is already saved, so a failure here never costs us the submission —
        // but it must be loud, or the client sits at "pending" with nobody aware.
        $apex = ApexService::sendOnboarding($client);
        $client->update(['apex_synced' => $apex['synced'], 'apex_note' => $apex['note']]);

        if (! $apex['synced']) {
            Log::error('Onboarding did NOT reach APEX — retry from the admin dashboard', [
                'onboarding_id' => $client->id,
                'client'        => $client->fullName(),
                'reason'        => $apex['note'],
            ]);
        }

        return redirect()->route('onboarding.thanks')->with('onboarded', true);
    }

    private function storeDoc(Request $request, string $field): ?string
    {
        if (! $request->hasFile($field)) {
            return null;
        }
        return $request->file($field)->store('onboarding', 'local');
    }
}
