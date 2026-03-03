<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\DetailGaleri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galeri = Galeri::with('detailGaleri')->latest()->paginate(10);
        return view('admin.galeri.index', compact('galeri'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.galeri.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'is_active' => 'boolean',
            'fotos' => 'required|array|min:1',
            'fotos.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'captions.*' => 'nullable|string|max:255'
        ], [
            'judul.required' => 'Judul galeri wajib diisi',
            'fotos.required' => 'Minimal harus upload 1 foto',
            'fotos.*.image' => 'File harus berupa gambar',
            'fotos.*.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'fotos.*.max' => 'Ukuran gambar maksimal 2MB'
        ]);

        // Create Galeri
        $galeri = Galeri::create([
            'judul' => $validated['judul'],
            'slug' => Str::slug($validated['judul']),
            'deskripsi' => $validated['deskripsi'] ?? null,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        // Upload and save photos
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $index => $foto) {
                $filename = time() . '_' . $index . '_' . $foto->getClientOriginalName();
                $path = $foto->storeAs('galeri', $filename, 'public');

                // Set first photo as thumbnail
                if ($index == 0) {
                    $galeri->update(['thumbnail' => $path]);
                }

                DetailGaleri::create([
                    'galeri_id' => $galeri->id,
                    'foto' => $path,
                    'caption' => $request->captions[$index] ?? null,
                    'urutan' => $index
                ]);
            }
        }

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $galeri = Galeri::with('detailGaleri')->findOrFail($id);
        return view('admin.galeri.show', compact('galeri'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $galeri = Galeri::with('detailGaleri')->findOrFail($id);
        return view('admin.galeri.edit', compact('galeri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $galeri = Galeri::findOrFail($id);

        // Validation
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'is_active' => 'boolean',
            'fotos' => 'nullable|array',
            'fotos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'captions.*' => 'nullable|string|max:255'
        ], [
            'judul.required' => 'Judul galeri wajib diisi',
            'fotos.*.image' => 'File harus berupa gambar',
            'fotos.*.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'fotos.*.max' => 'Ukuran gambar maksimal 2MB'
        ]);

        // Update Galeri
        $galeri->update([
            'judul' => $request->input('judul'),
            'slug' => Str::slug($request->input('judul')),
            'deskripsi' => $request->input('deskripsi'),
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        // Upload new photos if provided
        if ($request->hasFile('fotos')) {
            $currentCount = $galeri->detailGaleri()->count();
            $captions = $request->input('captions', []);
            
            foreach ($request->file('fotos') as $index => $foto) {
                $filename = time() . '_' . ($currentCount + $index) . '_' . $foto->getClientOriginalName();
                $path = $foto->storeAs('galeri', $filename, 'public');

                // Update thumbnail if it's the first photo and no thumbnail exists
                if ($currentCount == 0 && $index == 0) {
                    $galeri->update(['thumbnail' => $path]);
                }

                DetailGaleri::create([
                    'galeri_id' => $galeri->id,
                    'foto' => $path,
                    'caption' => isset($captions[$index]) ? $captions[$index] : null,
                    'urutan' => $currentCount + $index
                ]);
            }
        }

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $galeri = Galeri::findOrFail($id);

        // Delete all photos from storage
        foreach ($galeri->detailGaleri as $detail) {
            if (Storage::disk('public')->exists($detail->foto)) {
                Storage::disk('public')->delete($detail->foto);
            }
        }

        // Delete thumbnail
        if ($galeri->thumbnail && Storage::disk('public')->exists($galeri->thumbnail)) {
            Storage::disk('public')->delete($galeri->thumbnail);
        }

        // Delete galeri (cascade will delete detail_galeri)
        $galeri->delete();

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil dihapus');
    }

    /**
     * Delete single photo from detail galeri
     */
    public function deletePhoto(string $id)
    {
        $detail = DetailGaleri::findOrFail($id);
        $galeri = $detail->galeri;

        // Delete photo from storage
        if (Storage::disk('public')->exists($detail->foto)) {
            Storage::disk('public')->delete($detail->foto);
        }

        // If this photo is thumbnail, update thumbnail to next photo
        if ($galeri->thumbnail == $detail->foto) {
            $nextPhoto = $galeri->detailGaleri()->where('id', '!=', $id)->first();
            $galeri->update(['thumbnail' => $nextPhoto ? $nextPhoto->foto : null]);
        }

        $detail->delete();

        return redirect()->back()->with('success', 'Foto berhasil dihapus');
    }
}
