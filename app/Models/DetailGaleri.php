<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailGaleri extends Model
{
    use HasFactory;

    protected $table = 'detail_galeri';

    protected $fillable = [
        'galeri_id',
        'foto',
        'caption',
        'urutan'
    ];

    // Relationship with Galeri
    public function galeri()
    {
        return $this->belongsTo(Galeri::class, 'galeri_id');
    }
}
