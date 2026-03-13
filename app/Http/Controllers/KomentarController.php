<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    public function store(Request $request, $produk_id)
    {
        $request->validate(['isi_komentar' => 'required']);

        Komentar::create([
            'produk_id' => $produk_id,
            'user_id' => Auth::id(),
            'isi_komentar' => $request->isi_komentar
        ]);

        return back()->with('success', 'Komentar berhasil diposting.');
    }
    public function destroyKomentar($id)
    {
        $komentar = Komentar::with('produk')->findOrFail($id);
        if (
            Auth::user()->role === 'admin' ||
            Auth::id() == $komentar->user_id ||
            Auth::id() == $komentar->produk->user_id
        ) {
            $komentar->delete();
            return back()->with('success', 'Komentar berhasil dihapus.');
        }
        return back()->with('error', 'Akses ditolak!');
    }
}
