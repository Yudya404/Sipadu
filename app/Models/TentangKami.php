<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TentangKami extends Model
{
    use HasFactory;

    protected $table = 'tentang_kami';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'video',
        'deskripsi',
        'gambar1',
        'gambar2',
        'ket_gambar1',
        'ket_gambar2'
    ];
}
