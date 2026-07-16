<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('onboardings', function (Blueprint $table) {
            $table->id();

            // Client details
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('suffix')->nullable();
            $table->string('email');
            $table->string('phone')->nullable();
            $table->date('dob')->nullable();
            $table->text('ssn')->nullable();            // encrypted at rest

            // Mailing address
            $table->string('street')->nullable();
            $table->string('apt')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();

            // Documents (stored privately)
            $table->string('dl_path')->nullable();
            $table->string('ssn_card_path')->nullable();
            $table->string('proof_address_path')->nullable();

            // Credit monitoring
            $table->string('cm_provider')->nullable();
            $table->string('cm_email')->nullable();
            $table->text('cm_password')->nullable();          // encrypted at rest
            $table->text('cm_security_answer')->nullable();   // encrypted at rest

            // APEX sync tracking
            $table->boolean('apex_synced')->default(false);
            $table->text('apex_note')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('onboardings');
    }
};
