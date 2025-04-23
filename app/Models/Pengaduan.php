<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan'; // Nama tabel di database

    protected $primaryKey = 'id'; // Primary key

    public $timestamps = false; // Karena 'tgl_buat' digunakan sebagai timestamp manual

    protected $fillable = [
		'kode_formulir',
		'nik',
		'nama',
		'telp',
		'email',
		'alamat',
		'jenis_laporan',
		'judul',
		'isi',
		'tgl_kejadian',
		'id_instansi',
		'kategori',
		'bukti',
		'status',
		'tgl_buat',
		'via_wa',
		'wa_number',
		'wa_message_id'
	];

    protected $casts = [
        'tgl_buat' => 'datetime',
        'tgl_kejadian' => 'date', // 🔹 Pastikan tgl_kejadian dikonversi ke tipe tanggal
    ];
	
	// Relasi One-to-Many ke tabel Tanggapan
    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class, 'id_pengaduan', 'id');
    }
	
	// Relasi ke DinasLembaga
    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi');
    }
}
