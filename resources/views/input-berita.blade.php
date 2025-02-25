@extends('template')
@section('title', 'form tambah data')

@section('body')
<section id="form" class="pt-5 pb-5">
    <div class="container">
        <form method="post" action="/form" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-xl-5">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <h3 class="mt-3 mb-3 text-center text-ungu fw-bold">Form tambah data</h3>
                            @if ($errors->has('foto'))
                            <div class="text-danger">{{ $errors->first('foto') }}</div>
                            @endif
                            @if (Session::has('error'))
                            <div class="alert alert-danger d-flex justify-content-between">
                                {{ Session::get('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            <div class="mb-3">
                                <input type="text" class="form-control" name="judul" placeholder="Judul">
                            </div>
                            <div class="mb-3">
                                <select class="form-select" name="kategori" aria-label="Default select example">
                                    <option value="1">Berita Olahraga</option>
                                    <option value="2">Berita Kesehatan</option>
                                    <option value="3">Berita Kuliner</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="body">Berita</label>
                                <textarea name="body" id="body" rows="4" class="form-control"></textarea>
                            </div>
                            <div class="mb-3 position-relative">
                                <label for="foto" class="btn btn-ungu"> <i class="bi bi-arrow-bar-up"></i>Pilih foto</label>
                               
                                <input type="file" name="foto" id="foto" class="form-control position-absolute opacity-0 top-0"/>
                            </div>
                            <div class="mb-3">
                                <button class="form-control btn-ungu" type="submit">Tambah Data</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
