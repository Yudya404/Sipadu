<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;

    protected $table = 'instansi'; // Nama tabel di database

    protected $primaryKey = 'id'; // Primary key
	
	public $timestamps = false; // Tidak pakai created_at & updated_at bawaan Laravel	

    protected $fillable = ['nama', 'tipe', 'induk']; // Kolom yang bisa diisi (mass assignment)
	
	// Relasi ke Pengaduan
    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'id_instansi');
    }
	
	// Relasi ke User
    public function user()
    {
        return $this->hasMany(User::class, 'id_instansi');
    }
}
