@extends('template')

@section('title', $title)


@section('body')
<section id="category" class="pt-5 pb-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/news">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Category</li>
                <li class="breadcrumb-item active" aria-current="page">{{ $categoryName["kategori"] }}</li>
            </ol>
        </nav>
        @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
        @endif
        <h1 class="font-utama mb-3 mt-3">Portal {{ $categoryName["kategori"] }}</h1>
        <div class="row justify-content-center">
            <div class="col-12 col-md-12 col-xl-8 mb-2 mb-md-5">
                <div class="row justify-content-center">
                    @foreach($news as $berita)
                    <div class="col-10 col-md-6 col-xl-4 mb-3">
                        <div class="card border-0 shadow-sm">
                            <img src="{{ asset('storage/images/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                                class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><a href="/news/{{ $berita->id }}"
                                        class="text-decoration-none link-berita">{{ $berita->judul }}</a></h5>
                                <a href="/user/berita/{{ $berita->userNews->id }}"
                                    class="card-subtitle mb-2 text-body-secondary text-decoration-none link-category-berita">{{ $berita->userNews->nama }} |</a>
                                <a
                                    href="/category/{{ $berita->kategoriNews->id }}" class="text-decoration-none text-secondary link-category-berita">{{ $berita->kategoriNews->kategori }}</a>
                                <small class="d-block">{{ $berita->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="d-flex mt-4 mb-4 justify-content-center">
                        {{ $news->links() }}
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-xl-4">
                <h3 class="mt-3 mt-md-3 mt-xl-0">Mungkin anda sukai</h3>
                <hr style="border-top:3px solid black;">
                <ul class="list-group list-group-flush ">
                    @foreach($sports as $sport)
                    <li class="list-group-item d-flex gap-2 align-items-center overflow-hidden">
                        <img src="{{ asset('storage/images/' . $sport->gambar) }}" width="150px" alt="Gambar Berita">
                        <div>

                            <a href="/news/{{ $sport->id }}"
                                class="text-dark text-decoration-none link-category-berita">{{ $sport->judul }}
                            </a>
                            <small class="d-block text-secondary">{{ $sport->kategoriNews->kategori }}</small>
                        </div>
                    </li>
                    @endforeach
                    @foreach($healths as $health)
                    <li class="list-group-item d-flex gap-2 align-items-center overflow-hidden">
                        <img src="{{ asset('storage/images/' . $health->gambar) }}" width="150px" alt="Gambar Berita">
                        <div>

                            <a href="/news/{{ $health->id }}"
                                class="text-dark text-decoration-none link-category-berita">{{ $health->judul }}
                            </a>
                            <small class="d-block text-secondary">{{ $health->kategoriNews->kategori }}</small>
                        </div>

                    </li>
                    @endforeach
                    @foreach($culinaries as $culinary)
                    <li class="list-group-item d-flex gap-2 align-items-center overflow-hidden">
                        <img src="{{ asset('storage/images/' . $culinary->gambar) }}" width="150px" alt="Gambar Berita">
                        <div>

                            <a href="/news/{{ $culinary->id }}"
                                class="text-dark text-decoration-none link-category-berita">{{ $culinary->judul }}
                            </a>
                            <small class="d-block text-secondary">{{ $culinary->kategoriNews->kategori }}</small>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
