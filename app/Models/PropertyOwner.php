<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class PropertyOwner extends Model
{
    /**
     * Attributes that may be mass assigned.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'owner_type',
        'national_id',
        'passport_number',
        'tax_pin',
        'business_name',
        'business_registration_no',
        'address_line_1',
        'address_line_2',
        'city',
        'county',
        'state',
        'postal_code',
        'country',
        'signature',
        'emergency_contact_name',
        'emergency_contact_phone',
        'notes',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
