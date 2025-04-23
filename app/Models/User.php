<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users'; // Nama tabel di database

    protected $primaryKey = 'id'; // Primary key
	
	public $timestamps = false; // Tidak pakai created_at & updated_at bawaan Laravel

    protected $fillable = [
        'nip', 
		'nama', 
		'telp', 
		'email', 
		'alamat', 
		'id_instansi', 
		'jabatan',
        'role', 
		'foto', 
		'username', 
		'password', 
		'tgl_buat', 
		'aktivitas_login'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'tgl_buat' => 'datetime',
        'aktivitas_login' => 'datetime',
    ];
	
	// Event model untuk mengisi otomatis tgl_buat & aktivitas_login
    protected static function boot()
	{
		parent::boot();

		static::creating(function ($user) {
			$user->tgl_buat = now();
			$user->aktivitas_login = now();
		});

		static::updating(function ($user) {
			$user->aktivitas_login = now();
		});
	}

    // Cek apakah user memiliki role tertentu
    public function hasRole($role)
    {
        return $this->role === $role;
    }
	
	// Relasi One-to-Many ke Tanggapan
    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class, 'id_users', 'id');
    }
	
	// Relasi ke DinasLembaga
    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi', 'id');
    }

}
