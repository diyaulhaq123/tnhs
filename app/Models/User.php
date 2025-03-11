<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Payment;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the memberType associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function memberType(): HasOne
    {
        return $this->hasOne(MemberType::class, 'id', 'type');
    }

    /**
     * Get the profile associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    /**
     * Get all of the payments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'user_id', 'id');
    }

    /**
     * Get all of the successPayments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function successPayments(): HasMany
    {
        return $this->hasMany(Payment::class, 'user_id', 'id')->where('remark', 'success');
    }


    public function successPaymentsTotal(): float
    {
        return $this->successPayments()->sum('amount');
    }

    /**
     * Get all of the eventPayments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function eventPayments(): HasMany
    {
        return $this->hasMany(Payment::class, 'user_id', 'id')
        ->where('remark', 'success')->where('payment_type_id', '2');
    }

    /**
     * Get all of the membershipPayment for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function membershipPayment(): HasOne
    {
        return $this->hasOne(Payment::class, 'user_id', 'id')
            ->where('remark', 'success')
            ->where('payment_type_id', '1')
            ->latest();
    }

    /**
     * Get the unPaidEvent associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    // public function unPaidEvent(): HasMany
    // {
    //     return $this->hasMany(Payment::class, 'user_id', 'id');
    // }


    public function getUsers(){
        return Self::with('profile')->get();
    }

    public function getUsersByStatus($status){
        return Self::with('profile')->where('status', $status)->get();
    }



}
