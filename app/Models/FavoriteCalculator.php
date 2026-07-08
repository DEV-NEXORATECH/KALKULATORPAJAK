<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteCalculator extends Model
{
    protected $fillable = [
        'user_id',
        'kalkulator_type',
        'urutan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
