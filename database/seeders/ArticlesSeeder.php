<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('articles')->insert([
            'title' => 'Artikel Pertama',
            'content' => 'Ini adalah konten artikel pertama.',
            'image' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
