<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'npwp',
        'nik',
        'ptkp_status',
        'pekerjaan',
        'is_admin',
        'last_active_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'last_active_at' => 'datetime',
        ];
    }

    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }

    public function calculations()
    {
        return $this->hasMany(Calculation::class);
    }

    public function favoriteCalculators()
    {
        return $this->hasMany(FavoriteCalculator::class);
    }

    public function taxReminders()
    {
        return $this->hasMany(TaxReminder::class);
    }

    public function notifications()
    {
        return $this->hasMany(UserNotification::class);
    }

    public function defaultProfile()
    {
        return $this->hasOne(Profile::class)->where('is_default', true);
    }
}
