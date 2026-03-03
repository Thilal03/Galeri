<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    /**
     * Display a listing of galleries.
     */
    public function index()
    {
        $galeri = Galeri::with('detailGaleri')
            ->where('is_active', true)
            ->latest()
            ->paginate(12);
        
        return view('frontend.galeri.index', compact('galeri'));
    }

    /**
     * Display the specified gallery detail.
     */
    public function show($slug)
    {
        $galeri = Galeri::with('detailGaleri')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        
        return view('frontend.galeri.show', compact('galeri'));
    }
}
