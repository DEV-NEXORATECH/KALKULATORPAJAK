<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxReminder extends Model
{
    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'tanggal_jatuh_tempo',
        'tipe',
        'is_done',
        'reminded_at',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_jatuh_tempo' => 'date',
            'is_done' => 'boolean',
            'reminded_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
