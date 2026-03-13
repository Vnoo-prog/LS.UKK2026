@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Katalog Produk</h2>
        
        <a href="{{ route('produk.create') }}" class="btn btn-primary fw-bold">+ Tambah Produk</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse ($produks as $p)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <img src="{{ asset('uploads/produk/' . $p->gambar) }}" class="card-img-top" alt="Gambar Produk"
                        style="height: 250px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">{{ $p->judul }}</h5>
                        <p class="card-text text-truncate mb-3">{{ $p->deskripsi }}</p>
                        
                        <a href="{{ route('produk.show', $p->id) }}" class="btn btn-outline-dark btn-sm mb-2 w-100">Lihat Detail & Komentar</a>
                        
                        @if (Auth::user()->role === 'admin' || Auth::id() == $p->user_id)
                            <div class="d-flex gap-2 mt-auto pt-2 border-top">
                                <a href="{{ route('produk.edit', $p->id) }}" class="btn btn-sm btn-warning w-50 fw-bold">Edit</a>

                                <form action="{{ route('produk.destroy', $p->id) }}" method="POST" class="w-50"
                                    onsubmit="return confirm('Hapus produk ini secara permanen?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger w-100 fw-bold">Hapus</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div style="font-size: 3rem; color: #ccc;">📦</div>
                <h4 class="text-muted mt-3">Belum ada katalog produk.</h4>
                <p class="text-secondary small">Jadilah yang pertama menambahkan produk!</p>
            </div>
        @endforelse
    </div>
@endsection