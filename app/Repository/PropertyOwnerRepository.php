<?php

namespace App\Repository;

use App\Contracts\PropertyOwnerRepositoryInterface;
use App\Http\Requests\Api\V1\StorePropertyOwnerRequest;
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
     * @param StorePropertyOwnerRequest $request
     * @return User
     */
    public function storePropertyOwner(StorePropertyOwnerRequest $request): User
    {
        return DB::transaction(function () use ($request) {
            // Create the user
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'other_names' => $request->other_names,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'profile_photo' => $request->profile_photo,
                'address' => $request->address,
                'city' => $request->city,
                'county' => $request->county,
                'country' => $request->country ?? 'Kenya',
                'status' => 'active',
            ]);

            // Assign the property_owner role using Spatie
            $user->assignRole('property_owner');

            // Create the property owner record
            PropertyOwner::create([
                'user_id' => $user->id,
                'owner_type' => $request->owner_type ?? 'individual',
                'national_id' => $request->national_id,
                'passport_number' => $request->passport_number,
                'tax_pin' => $request->tax_pin,
                'business_name' => $request->business_name,
                'business_registration_no' => $request->business_registration_no,
                'address_line_1' => $request->address_line_1,
                'address_line_2' => $request->address_line_2,
                'city' => $request->owner_city,
                'county' => $request->owner_county,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'country' => $request->owner_country ?? 'Kenya',
                'signature' => $request->signature,
                'emergency_contact_name' => $request->emergency_contact_name,
                'emergency_contact_phone' => $request->emergency_contact_phone,
                'notes' => $request->notes,
            ]);

            return $user->load('propertyOwner'); // Load the relationship for response
        });
    }
}
