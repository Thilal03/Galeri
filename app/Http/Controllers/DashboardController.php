<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\guru;
use App\Models\siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the user dashboard with overview data.
     */
    public function index()
    {
        $totalGaleri = Galeri::where('is_active', true)->count();
        $totalGuru = guru::count();
        $totalSiswa = siswa::count();

        $guru = guru::with('siswas')->latest()->get();
        $siswa = siswa::with('guru')->latest()->get();

        return view('dashboard.index', compact(
            'totalGaleri', 'totalGuru', 'totalSiswa',
            'guru', 'siswa'
        ));
    }

    /**
     * Show gallery page within user panel.
     */
    public function galeri()
    {
        $galeri = Galeri::with('detailGaleri')
            ->where('is_active', true)
            ->latest()
            ->get();

        return view('galeri.user-index', compact('galeri'));
    }
}
