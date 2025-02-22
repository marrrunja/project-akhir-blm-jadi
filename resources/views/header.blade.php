<nav class="navbar py-3 px-2 navbar-expand-lg shadow sticky-top bg-ungu bg-white navbar-light">
    <div class="container">
        <a class="navbar-brand"><img src="/../assetsku/Book open.png" class="me-2" alt="logo">Enigma</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-3">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('news') ? 'active': ''}}" aria-current="page" href="/news">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('user/news/' . Session::get('id')) ? 'active' : '' }}" href="/user/news/{{ Session::get('id') }}">Berita saya</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('category/1') || request()->is('category/2') || request()->is('category/3')? 'active': '' }}" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Kategori
                    </a>
                    <ul class="dropdown-menu">
                        @foreach($categories as $category)
                        <li><a class="dropdown-item" href="/category/{{ $category->id }}">{{ $category->kategori }}</a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('form')? 'active': '' }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Session::get('nama') }}
                    </a>
                    <ul class="dropdown-menu">

                        <li class="nav-item">
                            <a href="/form" class="dropdown-item">Buat Berita</a>
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal -->
<form method="post" action="/logout">
    @csrf
    @method('delete')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Halaman Enigma Menyatakan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin logout?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary w-25" data-bs-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-primary w-25">Ya</button>
                </div>
            </div>
        </div>
    </div>
</form>
