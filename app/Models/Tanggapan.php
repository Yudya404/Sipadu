<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    use HasFactory;

    protected $table = 'tanggapan'; // Nama tabel di database

    protected $primaryKey = 'id'; // Primary key
	
	public $timestamps = false; // Karena 'tgl_buat' digunakan sebagai timestamp manual

    protected $fillable = [
        'id_pengaduan', 
		'id_users', 
		'kode_formulir', 
		'isi_tanggapan', 
		'tgl_ditanggapi', 
		'via_wa', 
		'wa_message_id', 
		'is_auto_reply'
    ];

    protected $casts = [
        'tgl_ditanggapi' => 'datetime',
    ];

    // Relasi Many-to-One ke Pengaduan
    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'id_pengaduan', 'id');
    }

    // Relasi Many-to-One ke Users
    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id');
    }
}
