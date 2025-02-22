<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        News::create([
            "judul" => "Berita hari ini",
            "body" => "Hari ini ditemukan seseorang tewas dalam kecelakaan, korban menderita luka-luka dan sebelumnya harus dimasukkan ke rumah sakit",
            "author" => "irfan",
            "gambar" => "yoshioka.jpg",
            "kategori" => "berita harian"
        ]);
    }
}
