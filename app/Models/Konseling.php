<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konseling extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'psikolog_id',
        'session_preference',
        'client_name',
        'client_email',
        'client_phone',
        'service_type',
        'consultation_date',
        'consultation_time',
        'description',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function psikolog()
    {
        // Relasi ke User, tapi menggunakan foreign key 'psikolog_id'
        return $this->belongsTo(User::class, 'psikolog_id');
    }
}
