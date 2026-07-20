<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyOwnerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->first_name . ' ' . $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'profile' => [
                'date_of_birth' => $this->date_of_birth,
                'gender' => $this->gender,
            ],
            'address' => [
                'address' => $this->address,
                'city' => $this->city,
                'county' => $this->county,
                'country' => $this->country,
            ],
            'property_owner' => [
                'owner_type' => $this->propertyOwner->owner_type,
                'business_name' => $this->propertyOwner->business_name,
                'address_line_1' => $this->propertyOwner->address_line_1,
                'address_line_2' => $this->propertyOwner->address_line_2,
                'city' => $this->propertyOwner->city,
                'county' => $this->propertyOwner->county,
                'country' => $this->propertyOwner->country,
                'emergency_contact' => [
                    'name' => $this->propertyOwner->emergency_contact_name,
                    'phone' => $this->propertyOwner->emergency_contact_phone,
                ],
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
