@extends('template')

@section('title', $title)

@section('body')
<section id="berita" class="pt-5 pb-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/news">Home</a>
            </li>
            <li class="breadcrumb-item">News
                <li class="breadcrumb-item active" aria-current="page">{{ $news->judul }}</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-12 col-md-12 col-xl-8">
                <h1 class="font-judul mb-2">{{ $news->judul }}</h1>
                <div class="text-center text-md-start">
                    <figure class="figure">
                        <img src="{{ asset('storage/images/' . $news->gambar) }}" class="figure-img rounded" width="300"
                            alt="">
                        <div class="d-flex justify-content-between">
                            <figcaption class="figure-caption text-end fw-semibold text-secondary">
                                {{ $news->userNews->nama }}</figcaption>
                            <figcaption class="figure-caption text-end fw-semibold text-secondary">
                                {{ \Carbon\Carbon::parse($news->created_at)->translatedFormat('d F Y')}}</figcaption>
                        </div>
    
                    </figure>
                </div>
                <div class="mt-3 text-wrap lh-lg">
                    {{ $news->body }}
                </div>
            </div>
            <div class="col-12 col-md-12 col-xl-4">
                <h3 class="mt-3 mt-md-3 mt-xl-0">Terbaru</h3>
                <hr style="border-top:3px solid black;">
                <ul class="list-group list-group-flush ">
                    @foreach($beritaTerbaru as $new)
                    <li class="list-group-item d-flex gap-2 align-items-center overflow-hidden">
                        <img src="{{ asset('storage/images/' . $new->gambar) }}" width="150px" alt="Gambar Berita">
                        <a href="/news/{{ $new->id }}"
                            class="text-dark text-decoration-none link-new-berita">{{ $new->judul }}
                            <small class="d-block text-secondary">{{ $new->created_at->diffForHumans() }}</small>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
