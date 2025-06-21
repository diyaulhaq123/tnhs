<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MembershipSequence extends Model
{
    use HasFactory;

    protected $table = 'membership_sequences';

    protected $fillable = [
        'last_sequence_number',
    ];


    /**
     * The attributes that should be cast.
     * Removed 'year' casting.
     * @var array<string, string>
     */
    protected $casts = [
        'last_sequence_number' => 'integer',
    ];

    


}
