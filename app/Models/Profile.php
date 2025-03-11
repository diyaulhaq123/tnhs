<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
       'user_id', 'first_name', 'last_name', 'other_name', 'phone_number',	'gender', 	'marital_status', 	'nationality', 	'state',
       'lga', 'town', 'address_line_1', 'address_line_2', 	'date_of_birth', 	'place_of_birth', 'avatar'
    ];
}
