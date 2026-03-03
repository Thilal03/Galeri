<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use App\Models\guru;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = siswa::with('guru')->get();
        return view('siswa.index', compact('siswa'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $siswa = siswa::with('guru')->findOrFail($id);
        return view('siswa.show', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $guru = guru::all();
        return view('siswa.create', compact('guru'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'guru_id' => 'required|exists:gurus,id',
            'nama_siswa' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
        ]);

        siswa::create($request->all());

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $siswa = siswa::findOrFail($id);
        $guru = guru::all();
        return view('siswa.edit', compact('siswa', 'guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'guru_id' => 'required|exists:gurus,id',
            'nama_siswa' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
        ]);

        $siswa = siswa::findOrFail($id);
        $siswa->update($request->all());

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $siswa = siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
