<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;

    protected $table = 'footer'; // Nama tabel

    protected $primaryKey = 'id'; // Primary key

    public $timestamps = true; // Gunakan timestamp (created_at & updated_at)

    protected $fillable = [
        'maps',
        'telp',
        'alamat',
        'gambar1',
        'gambar2',
        'gambar3',
    ];
}
