<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'nama',
        'npwp',
        'nik',
        'ptkp_status',
        'pekerjaan',
        'perusahaan',
        'is_default',
    ];

    protected function casts(): array
    {
        return [
            'is_default' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function calculations()
    {
        return $this->hasMany(Calculation::class);
    }
}
