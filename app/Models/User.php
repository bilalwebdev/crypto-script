<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Searchable;

    protected $casts = [
        'address' => 'object',
        'kyc_information' => 'array'
    ];


    public function accounts()
    {
        return $this->hasMany(Account::class, 'user_id');
    }


    public function loginSecurity()
    {
        return $this->hasOne(LoginSecurity::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(PlanSubscription::class);
    }

    public function currentplan()
    {
        return $this->subscriptions()->where('is_current', 1);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id');
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class, 'user_id');
    }

    public function withdraws()
    {
        return $this->hasMany(Withdraw::class, 'user_id');
    }

    public function refferals()
    {
        return $this->hasMany(User::class, 'ref_id');
    }

    public function refferedBy()
    {
        return $this->belongsTo(User::class, 'ref_id');
    }

    public function reffer()
    {
        return $this->hasMany(User::class, 'ref_id');
    }

    public function interest()
    {
        return $this->hasMany(UserInterest::class, 'user_id');
    }

    public function commissions()
    {
        return $this->hasMany(ReferralCommission::class, 'commission_to');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'user_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id');
    }

    public function dashboardSignal()
    {
        return $this->hasMany(DashboardSignal::class);
    }

    public function trades()
    {
        return $this->hasMany(Trade::class, 'user_id');
    }

    public function kycinfo()
    {
        return $this->hasMany(KycDocs::class, 'user_id');
    }
}
