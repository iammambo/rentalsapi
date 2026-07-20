<?php

namespace App\Repository;

use App\Contracts\PropertyOwnerRepositoryInterface;
use App\Models\PropertyOwner;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PropertyOwnerRepository implements PropertyOwnerRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Store a newly created property owner in storage.
     *
     * @param array<string, mixed> $data
     * @return User
     */
    public function storePropertyOwner(array $data): User
    {
        return DB::transaction(function () use ($data) {
            // Create the user
            $user = User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'other_names' => $data['other_names'] ?? null,
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => Hash::make($data['password']),
                'date_of_birth' => $data['date_of_birth'] ?? null,
                'gender' => $data['gender'] ?? null,
                'profile_photo' => $data['profile_photo'] ?? null,
                'address' => $data['address'] ?? null,
                'city' => $data['city'] ?? null,
                'county' => $data['county'] ?? null,
                'country' => $data['country'] ?? 'Kenya',
                'status' => 'active',
            ]);

            // Assign the property_owner role using Spatie
            $user->assignRole('property_owner');

            // Create the property owner record
            PropertyOwner::create([
                'user_id' => $user->id,
                'owner_type' => $data['owner_type'] ?? 'individual',
                'national_id' => $data['national_id'] ?? null,
                'passport_number' => $data['passport_number'] ?? null,
                'tax_pin' => $data['tax_pin'] ?? null,
                'business_name' => $data['business_name'] ?? null,
                'business_registration_no' => $data['business_registration_no'] ?? null,
                'address_line_1' => $data['address_line_1'],
                'address_line_2' => $data['address_line_2'] ?? null,
                'city' => $data['owner_city'],
                'county' => $data['owner_county'] ?? null,
                'state' => $data['state'] ?? null,
                'postal_code' => $data['postal_code'] ?? null,
                'country' => $data['owner_country'] ?? 'Kenya',
                'signature' => $data['signature'] ?? null,
                'emergency_contact_name' => $data['emergency_contact_name'] ?? null,
                'emergency_contact_phone' => $data['emergency_contact_phone'] ?? null,
                'notes' => $data['notes'] ?? null,
            ]);

            return $user->load('propertyOwner'); // Load the relationship for response
        });
    }
}
