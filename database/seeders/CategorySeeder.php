<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'kategori' => 'Berita Olahraga'
        ]);
        Category::create([
            'kategori' => 'Berita Kesehatan'
        ]);
        Category::create([
            'kategori' => 'Berita Kuliner'
        ]);
    }
}
