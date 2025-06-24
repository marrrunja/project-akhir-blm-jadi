@extends('template')
@section('title', 'form tambah data')

@section('body')
<section id="form" class="pt-5 pb-5">
    <div class="container">
        <form method="post" action="/form" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-xl-8">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <h3 class="mt-3 mb-3 text-center text-ungu fw-bold">Form tambah data</h3>
                            @if(Session::has('status'))
                            <div class="alert alert-success d-flex justify-content-center">
                                {{ Session::get('status') }}
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            @error('foto')
                            <div class="alert alert-danger d-flex justify-content-between">
                                {{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @enderror
                            <div class="mb-3">
                                <input type="text" class="form-control" name="judul" placeholder="Judul">
                            </div>
                            <div class="mb-3">
                                <select class="form-select" name="category_id" aria-label="Default select example">
                                    <option value="1">Berita Olahraga</option>
                                    <option value="2">Berita Kesehatan</option>
                                    <option value="3">Berita Kuliner</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <textarea name="body" id="editor1" rows="10" cols="80">Masukkan isi berita anda disini</textarea>
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
