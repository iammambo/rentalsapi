<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('property_owners', function (Blueprint $table) {
            $table->id();

            // Link to users table
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            // Owner Information
            $table->string('owner_type')->default('individual');


            // Identification
            $table->string('national_id', 50)->nullable();
            $table->string('passport_number', 50)->nullable();
            $table->string('tax_pin', 100)->nullable();
            $table->string('business_name')->nullable();
            $table->string('business_registration_no')->nullable();


            // Address
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('city');
            $table->string('county')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->default('Kenya');


            // Documents
            $table->string('signature')->nullable();

            // Emergency Contact
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();

            // Additional Information
            $table->text('notes')->nullable();



            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_owners');
    }
};
