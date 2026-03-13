@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 mb-4">
        <img src="{{ asset('uploads/produk/' . $produk->gambar) }}" class="img-fluid rounded shadow" alt="{{ $produk->judul }}">
    </div>
    <div class="col-md-6">
        <h2 class="fw-bold">{{ $produk->judul }}</h2>
        <p class="mt-3">{{ $produk->deskripsi }}</p>
        <hr>

        <h4>Komentar ({{ $produk->komentars->count() }})</h4>
        <div class="mb-4" style="max-height: 300px; overflow-y: auto;">
            @foreach($produk->komentars as $k)
            <div class="bg-white p-2 rounded border mb-2 shadow-sm">
                <strong>{{ $k->user->username }} <span class="badge bg-secondary">{{ $k->user->role }}</span></strong>
                <p class="mb-0 text-muted small">{{ $k->isi_komentar }}</p>
            </div>
            @endforeach
        </div>

        <form action="{{ route('komentar.store', $produk->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <textarea name="isi_komentar" rows="3" class="form-control" placeholder="Tulis komentar..." required></textarea>
            </div>
            <button type="submit" class="btn btn-dark w-100">Kirim Komentar</button>
        </form>
    </div>
</div>
@endsection