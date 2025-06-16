<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MembershipCategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table =  'membership_categories';
}
