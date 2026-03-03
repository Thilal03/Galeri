<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    use HasFactory;
    protected $fillable = [
        'guru_id',
        'nama_siswa',
        'kelas',
    ];

    public function guru()
    {
        return $this->belongsTo(guru::class);
    }
}
