@extends('layouts.app')

@section('content')
<div class="card shadow-sm col-md-8 mx-auto">
    <div class="card-body">
        <h4 class="card-title mb-4">Tambah Produk Baru</h4>
        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>Judul Produk</label>
                <input type="text" name="judul" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label>Upload Gambar (JPEG, PNG, JPG)</label>
                <input type="file" name="gambar" class="form-control" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Produk</button>
            <a href="{{ route('produk.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection