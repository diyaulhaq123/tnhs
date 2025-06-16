<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the membershipCategory that owns the Profile
     *
     * @return BelongsTo
     */
    public function membershipCategory(): BelongsTo
    {
        return $this->belongsTo(MembershipCategory::class);
    }

}
