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
        return $this->belongsTo(MembershipCategory::class, 'membership_category_id', 'id');
    }

    /**
     * Get the state that owns the Profile
     *
     * @return BelongsTo
     */
    public function states(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state', 'id');
    }
    /**
     * Get the lga that owns the Profile
     *
     * @return BelongsTo
     */
    public function lgas(): BelongsTo
    {
        return $this->belongsTo(Lga::class, 'lga', 'id');
    }
    /**
     * Get the user that owns the Profile
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
