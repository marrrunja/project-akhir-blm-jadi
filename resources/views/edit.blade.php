@extends('template')
@section('title', $title)

@section('body')
<section id="edit" class="pt-5 pb-5">
    <div class="container">
        <form method="post" action="{{ route('news.update', $news->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h1 class="text-center mb-4">Form Ubah data</h1>
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-8 col-xl-6">
                    <div class="card">
                        <img src="{{ asset('storage/images/' . $news->gambar) }}" class=" card-img-top img-fluid"
                            alt="{{ $news->judul }}">
                        <div class="card-body">
                            @if (Session::has('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                            </div>
                            @endif
                            @if (Session::has('status'))
                            <div class="alert alert-success">
                                {{ Session::get('status') }}
                            </div>
                            @endif
                            <div class="mb-3 d-flex">
                                <input type="hidden" name="id" value="{{ $news->id }}">
                                <input type="hidden" name="foto" value="{{ $news->gambar }}">
                                <input type="text" class="form-control" name="judul" placeholder="Judul"
                                    value="{{ $news->judul }}">
                            </div>
                            <select class="form-select" name="kategori" aria-label="Default select example">
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" @selected( $news->category_id == $category->id
                                    )>{{ $category->kategori }}</option>
                                @endforeach
                            </select>
                            <div class="mb-3">
                                <!-- {{ request()->route('id') }} -->
                            </div>
                            <div class="mb-4">
                                <label for="body">Berita</label>
                                <textarea name="body" id="body" rows="4" class="form-control">
                                        {{ $news->body }}
                                    </textarea>
                            </div>
                            <div class="mb-3 position-relative">
                                <label for="foto" class="form-label btn btn-ungu"><i
                                        class="bi bi-arrow-bar-up"></i>Pilih foto</label>
                                    <small class="text-ungu d-block fw-bold"><i class="bi bi-exclamation-diamond me-2"></i>Kosongkan jika tidak ingin diganti</small>
                                <input type="file" name="gambar" id="foto" class="form-control opacity-0 position-absolute top-0">
                            </div>
                            <div class="mb-3">
                                <button class="form-control btn btn-ungu" type="submit">Update Data</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
