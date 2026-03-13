<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::latest()->get();
        return view('produk.index', compact('produks'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image'
        ]);
        $nama_gambar = time() . '_' . $request->file('gambar')->getClientOriginalName();
        $request->file('gambar')->move(public_path('uploads/produk'), $nama_gambar);
        Produk::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar' => $nama_gambar,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show($id)
    {
        $produk = Produk::with('komentars.user')->findOrFail($id);
        return view('produk.show', compact('produk'));
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        if (Auth::user()->role !== 'admin' && Auth::id() != $produk->user_id) {
            return redirect()->route('produk.index')->with('error', 'Akses Ditolak! Anda hanya bisa mengedit produk milik Anda sendiri.');
        }

        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        if (Auth::user()->role !== 'admin' && Auth::id() != $produk->user_id) {
            return redirect()->route('produk.index')->with('error', 'Akses Ditolak! Anda tidak berhak mengubah produk ini.');
        }
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image'
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ];
        if ($request->hasFile('gambar')) {
            if ($produk->gambar && file_exists(public_path('uploads/produk/' . $produk->gambar))) {
                unlink(public_path('uploads/produk/' . $produk->gambar));
            }
            $nama_gambar = time() . '_' . $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move(public_path('uploads/produk'), $nama_gambar);
            $data['gambar'] = $nama_gambar;
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        if (Auth::user()->role !== 'admin' && Auth::id() != $produk->user_id) {
            return redirect()->route('produk.index')->with('error', 'Akses Ditolak! Anda hanya bisa menghapus produk milik Anda sendiri.');
        }
        if ($produk->gambar && file_exists(public_path('uploads/produk/' . $produk->gambar))) {
            unlink(public_path('uploads/produk/' . $produk->gambar));
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus secara permanen!');
    }
}
