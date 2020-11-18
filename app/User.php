<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'provider', 'provider_id', 'is_admin', 'email_verification_token', 'email_verified_at', 'email_verified', 'updated_by', 'ip_address', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function bikes() {
        return $this->hasMany('App\Models\Bike', 'rider_id');
    }

    public function rides() {
        return $this->hasMany('App\Models\Ride', 'rider_id');
    }

    public function profile() {
        return $this->hasOne('App\Models\RiderProfile', 'rider_id');
    }

    public function groups() {
        return $this->hasMany('App\Models\Group', 'create_rider_id');
    }

    public function suppliers() {
        return $this->hasMany('App\Models\Supplier', 'rider_id');
    }

    public function tips() {
        return $this->hasMany('App\Models\Tip', 'rider_id');
    }

    public function polls() {
        return $this->hasMany('App\Models\Poll', 'rider_id');
    }

    public function approvalComments() {
        return $this->hasMany('App\Models\ApprovalStatusComment', 'referer_id');
    }

    public function followedRiders() {
        return $this->hasMany('App\Models\RiderFollow', 'rider_id');
    }
}
