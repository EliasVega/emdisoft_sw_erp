<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [

        'name',
        'number',
        'address',
        'phone',
        'email',
        'password',
        'position',
        'transfer',
        'status',
        'company_id',
        'branch_id',
        'identification_type_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function identificationType()
    {
        return $this->belongsTo(IdentificationType::class);
    }

    public function VerificationCode(){
        return $this->hasOne(Verification_code::class);
    }

    public function transfer()
    {
        return $this->hasMany(Transfer::class);
    }

    public function pays()
    {
        return $this->hasMany(pay::class);
    }

    public function advances()
    {
        return $this->hasMany(Advance::class);
    }

    public function purchases(){
        return $this->hasMany(Purchase::class);
    }

    public function ncpurchases(){
        return $this->hasMany(Ncpurchase::class);
    }

    public function ndpurchases(){
        return $this->hasMany(Ndpurchase::class);
    }

    public function ncinvoices(){
        return $this->hasMany(Ncinvoice::class);
    }/*

    public function ndinvoices(){
        return $this->hasMany(Ndinvoice::class);
    }

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function payorders(){
        return $this->hasMany(Payorder::class);
    }*/



    public function cashOutflows(){
        return $this->hasMany(CashOutflow::class);
    }

    public function cashInflows(){
        return $this->hasMany(CashInflow::class);
    }

    public function cashRegisters(){
        return $this->hasMany(CashRegister::class);
    }
}
