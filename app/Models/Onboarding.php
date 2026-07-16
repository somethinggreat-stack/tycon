<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Onboarding extends Model
{
    protected $fillable = [
        'first_name', 'middle_name', 'last_name', 'suffix',
        'email', 'phone', 'dob', 'ssn',
        'street', 'apt', 'city', 'state', 'zip',
        'dl_path', 'ssn_card_path', 'proof_address_path',
        'cm_provider', 'cm_email', 'cm_password', 'cm_security_answer',
        'apex_synced', 'apex_note',
    ];

    protected $casts = [
        'dob'                => 'date',
        'apex_synced'        => 'boolean',
        // sensitive fields encrypted at rest
        'ssn'                => 'encrypted',
        'cm_password'        => 'encrypted',
        'cm_security_answer' => 'encrypted',
    ];

    public function fullName(): string
    {
        return trim(collect([$this->first_name, $this->middle_name, $this->last_name, $this->suffix])
            ->filter()->implode(' '));
    }
}
