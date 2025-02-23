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
                        <div>
                            <a href="/news/{{ $new->id }}"
                                class="text-dark text-decoration-none link-category-berita">{{ $new->judul }}
                            </a>
                            <small class="d-block text-secondary">{{ $new->created_at->diffForHumans() }}</small>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
<section id="terkait" class="bg-white pt-5 pb-5">
    <div class="container ps-3">
        <h1 class="mb-4">Berita terkait</h1>
        <div class="row justify-content-center">
            <div class="col-12 mx-auto">
                <div class="row justify-content-center flex-wrap gap-4">
                    @foreach($likeUser as $like)
                    <div class="col-sm-12 col-md-8 col-xl-3 overflow-hidden">
                        <img src="{{ asset('storage/images/'.$like->gambar) }}" class="img-fluid rounded img-terkait" alt="{{ $like->judul }}">
                        <div class="text-wrap" style="width:200px;">
                            <a href="/news/{{ $like->id }}"
                                class="text-dark fw-semibold text-decoration-none link-category-berita">{{ $like->judul }}</a>
                        </div>
                    </div>
                    @endforeach
                </div>
              
            </div>
        </div>
    </div>

</section>
@endsection
