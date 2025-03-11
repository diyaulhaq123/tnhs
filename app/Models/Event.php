<?php

namespace App\Models;

// use App\Models\MemberType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
//     protected $fillable = [ 'title', 'description', 'date', 'status', 'amount', 'member_type_id'
// ];
    protected $guarded = [];

    /**
     * Get the memberType associated with the event
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function memberType(): HasOne
    {
        return $this->hasOne(MemberType::class, 'id', 'member_type_id');
    }

}
