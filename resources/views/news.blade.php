@extends('template')

@section('title', $title)


@section('body')
<div class="container pt-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>
    <h1>Portal Berita</h1>
    <div class="enigma-wrapper">
        <main class="enigma-layout">
            <div class="enigma-main">
                <h1 class="enigma-heading fs-1 fw-bold">Terbaru</h1>
                @foreach($carousels as $carousel)
                <div class="enigma-feature">
                    <img src="{{ asset('storage/images/'.$carousel->gambar) }}" alt="Avocado"
                        class="enigma-feature-img">
                    <div class="enigma-feature-text">
                        <span class="enigma-tag">{{ $carousel->kategoriNews->kategori }}</span>
                        <h3><a href="/news/{{ $carousel->id }}" class="text-white text-decoration-none">{{ $carousel->judul }}</a></h3>
                    </div>
                </div>
                @endforeach
            </div>
            <aside class="enigma-sidebar">
                <div class="enigma-spotlight">
                    <img src="{{ asset('storage/images/' . $firstRandomNews['gambar']) }}" alt="Space" class="enigma-spotlight-img">
                    <h3><a href="/news/{{ $firstRandomNews['id'] }}" class="text-dark text-decoration-none link-category-berita">{{ $firstRandomNews["judul"] }}</a></h3>
                    <div class="enigma-pagination">
                        <span class="enigma-page-dot active"></span>
                        <span class="enigma-page-dot"></span>
                        <span class="enigma-page-dot"></span>

                    </div>
                    <div class="enigma-news-feed">
                        @foreach($randomNews as $random)
                        <div class="enigma-news-card">
                            <img src="{{ asset('storage/images/' . $random->gambar) }}" alt="Phone" class="enigma-news-thumbnail">
                            <div class="enigma-news-details">
                                <span class="enigma-tag">{{ $random->kategoriNews->kategori }}</span>
                                <h4 class="enigma-news-title"><a href="/news/{{ $random->id }}" class="text-dark text-decoration-none link-category-berita">{{ $random->judul }}</a>
                                </h4>
                                <p class="enigma-news-meta">{{ $random->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </aside>
        </main>
    </div>
    <!-- <div class="row mb-5 justify-content-center">
        <h3 class="mb-3">Terbaru</h3>
        <hr class="garis">
        @foreach($carousels as $carousel)
        <div class="col-12 col-md-5 col-xl-4 mb-4 mt-3">
            <div class="card card-thumbnail border-0 text-bg-dark mx-auto">
                <img src="{{ asset('storage/images/'.$carousel->gambar) }}" alt="{{ $carousel->judul }}"
                    class="card-img" style=" filter: grayscale(70%);">
                <div class="card-img-overlay">
                    <h5 class="card-title"><a href="/news/{{ $carousel->id }}"
                            class="text-decoration-none text-white">{{ $carousel->judul }}</a></h5>
                    <p class="card-text">{{ Str::limit($carousel->body,80) }}</p>
                    <p class="card-text">
                        <small>{{ \Carbon\Carbon::parse($carousel->created_at)->format('d M Y')}}</small></p>
                </div>
            </div>
        </div>
        @endforeach
    </div> -->
    <div class="row justify-content-center">
        <h1>Semua Berita</h1>
        <hr class="garis">
        @foreach($news as $berita)
        <div class="col-10 col-md-5 col-xl-3 mb-2 mb-md-5">
            <div class="card border-0 shadow-sm">
                <img src="{{ asset('storage/images/' . $berita->gambar) }}" class="card-img-top"
                    alt="{{ $berita->gambar }}">
                <div class="card-body">
                    <h5 class="card-title"><a href="/news/{{ $berita->id }}" class="text-decoration-none link-category-berita">{{ $berita->judul }}</a></h5>
                    <a href="/user/berita/{{ $berita->userNews->id }}"
                        class="card-subtitle mb-2 text-body-secondary">{{ $berita->userNews->nama }} |</a>
                    <a href="/category/{{ $berita->kategoriNews->id }}">{{ $berita->kategoriNews->kategori }}</a>
                    <div class="card-text">
                        <small>{{ $berita->created_at->diffForHumans() }}</small>
                    </div>
                    <!-- <p class="card-text">{{ Str::limit($berita->body,90) }}</p> -->
                    <div class="d-flex gap-2">
                        <!-- <a href="/news/edit/{{ $berita->id }}" class="btn btn-primary">Update data</a> -->
                        <!-- <form method="post" action="{{ route( 'news.destroy', $berita->id ) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form> -->
                    </div>
                    <!-- <a href="/news/{{ $berita->id }}">Baca Selengkapnya &raquo</a> -->
                </div>
            </div>
        </div>
        @endforeach
        <div class="d-flex mt-4 justify-content-center">
            {{ $news->links() }}
        </div>
    </div>
</div>


<script>
    const images = [
        "https://source.unsplash.com/400x250/?nature",
        "https://source.unsplash.com/400x250/?technology",
        "https://source.unsplash.com/400x250/?city",
        "https://source.unsplash.com/400x250/?ocean"
    ];

    document.getElementById("randomImage").src = images[Math.floor(Math.random() * images.length)];

</script>

@endsection
