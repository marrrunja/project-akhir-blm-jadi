@extends('template')

@section('title', $title)
@section('body')
<section id="user-news" class="pt-5 pb-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/news">Home</a></li>
                <li class="breadcrumb-item">News By {{ $username }}</li>
            </ol>
        </nav>
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
        <h1 class="font-utama mb-3 mt-3">Berita yang ditulis oleh {{ $username }}</h1>
        <div class="row gap-3 justify-content-center">
            @foreach($news as $berita)
            <div class="col-10 col-md-5 col-xl-3">
                <div class="card border-0 shadow-sm">
                    <img src="{{ asset('storage/images/' . $berita->gambar) }}" class="card-img-top"
                        alt="{{ $berita->gambar }}">
                    <div class="card-body">
                        <h5 class="card-title"><a href="/news/{{ $berita->id }}" class="text-decoration-none link-category-berita">{{ $berita->judul }}</a></h5>
                        <a href="/user/berita/{{ $berita->userNews->id }}"
                            class="card-subtitle mb-2 text-body-secondary">{{ $berita->userNews->nama }} |</a>
                        <a href="/category/{{ $berita->kategoriNews->id }}">{{ $berita->kategoriNews->kategori }}</a>
                        <small>{{ $berita->created_at->diffForHumans() }}</small>
                        <!-- <p class="card-text">{{ Str::limit($berita->body,70) }}</p> -->
                        <a href="/news/{{ $berita->id }}" class="text-decoration-none link-category-berita">Baca Selengkapnya &raquo</a>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="mt-4 mb-4 d-flex justify-content-center">
                {{ $news->links() }}
            </div>
        </div>
    </div>
</section>
@endsection
