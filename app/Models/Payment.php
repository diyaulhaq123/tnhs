<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'payment_type_id', 'event_id', 'remark', 'amount', 'reference'
    ];

    /**
     * Get the memberType associated with the Payment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    // public function memberType(): HasOne
    // {
    //     return $this->hasOne(MemberType::class, 'id', 'member_type');
    // }

    /**
     * Get the user that owns the Payment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the user that owns the Payment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }

    public function totalsuccessfulPayments(){
        $payments = Self::all()->sum('amount');
        return $payments;
    }

    public function paymentType()
    {
        $paymentTypeId = $this->payment_type_id;

        if ($paymentTypeId == 1) {
            $value = 'Membership';
        } else {
            $value = 'Event';
        }

        return $value;
    }



}

