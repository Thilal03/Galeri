<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri';

    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'thumbnail',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relationship with DetailGaleri
    public function detailGaleri()
    {
        return $this->hasMany(DetailGaleri::class, 'galeri_id')->orderBy('urutan');
    }

    // Auto generate slug from judul
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($galeri) {
            if (empty($galeri->slug)) {
                $galeri->slug = Str::slug($galeri->judul);
            }
        });

        static::updating(function ($galeri) {
            if ($galeri->isDirty('judul') && empty($galeri->slug)) {
                $galeri->slug = Str::slug($galeri->judul);
            }
        });
    }
}
