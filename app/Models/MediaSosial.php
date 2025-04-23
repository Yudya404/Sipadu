<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaSosial extends Model
{
    use HasFactory;

    protected $table = 'media_sosial'; // Nama tabel di database

    protected $fillable = [
        'whatsapp', 
		'instagram', 
		'tiktok', 
		'twitter', 
		'facebook', 
		'email'
    ];

    public $timestamps = true; // Karena created_at dan updated_at otomatis diisi
}
