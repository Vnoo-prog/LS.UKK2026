@extends('layouts.app')

@section('content')
<div class="card shadow-sm col-md-8 mx-auto">
    <div class="card-body">
        <h4 class="card-title mb-4">Edit Produk</h4>
        <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Judul Produk</label>
                <input type="text" name="judul" class="form-control" value="{{ $produk->judul }}" required>
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4" required>{{ $produk->deskripsi }}</textarea>
            </div>
            <div class="mb-3">
                <label>Gambar Baru (Kosongkan jika tidak ingin ganti)</label>
                <input type="file" name="gambar" class="form-control" accept="image/*">
                <small class="text-muted d-block mt-2">Gambar saat ini: <img src="{{ asset('uploads/produk/'.$produk->gambar) }}" width="80"></small>
            </div>
            <button type="submit" class="btn btn-warning">Update Produk</button>
            <a href="{{ route('produk.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection