@extends('template')

@section('title', $title)
@section('body')
<section id="user-news" class="pt-5 pb-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/news">Home</a></li>
                <li class="breadcrumb-item">Berita Saya</li>

                <li class="breadcrumb-item active" aria-current="page">{{ Session::get('nama') }}</li>
            </ol>
        </nav>
        <h1 class="font-utama mt-4 mb-5">Berita Saya</h1>
        <div class="row gap-3 justify-content-center">
            @foreach($news as $berita)
            <div class="col-10 col-md-5 col-xl-3">
                @if (Session::has('status'))
                <div class="alert alert-success">
                    {{ Session::get('status') }}
                </div>
                @endif
                @if (Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
                @endif
                <div class="card">
                    <img src="{{ asset('storage/images/' . $berita->gambar) }}" class="card-img-top"
                        alt="{{ $berita->gambar }}">
                    <div class="card-body">
                        <h5 class="card-title"><a href="/news/{{ $berita->id }}">{{ $berita->judul }}</a></h5>
                        <a href="/user/berita/{{ $berita->userNews->id }}"
                            class="card-subtitle mb-2 text-body-secondary">{{ $berita->userNews->nama }} |</a>
                        <a href="/category/{{ $berita->kategoriNews->id }}">{{ $berita->kategoriNews->kategori }}</a>
                        <small>{{ $berita->created_at->diffForHumans() }}</small>
                        <p class="card-text">{{ Str::limit($berita->body,90) }}</p>
                        <div class="d-flex gap-2">
                            <a href="/news/edit/{{ $berita->id }}" class="btn btn-primary">Update data</a>
                            <form method="post" action="{{ route( 'news.destroy', $berita->id ) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                        <a href="/news/{{ $berita->id }}">Baca Selengkapnya &raquo</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
