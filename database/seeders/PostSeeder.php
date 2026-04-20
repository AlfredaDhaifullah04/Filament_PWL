<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        Post::create([
            'title' => 'Belajar Laravel Dasar',
            'slug' => 'belajar-laravel-dasar',
            'category_id' => 1,
            'color' => '#ff0000',
            'image' => null,
            'body' => 'Ini adalah konten belajar Laravel.',
            'tags' => ['laravel', 'php'],
            'published' => true,
            'published_at' => now(),
        ]);
        Post::create([
            'title' => 'Tutorial Filament Admin',
            'slug' => 'tutorial-filament-admin',
            'category_id' => 1,
            'color' => '#00ff00',
            'image' => null,
            'body' => 'Panduan membuat admin panel dengan Filament.',
            'tags' => ['filament', 'admin'],
            'published' => false,
            'published_at' => null,
        ]);
        Post::create([
            'title' => 'Tips PHP Modern',
            'slug' => 'tips-php-modern',
            'category_id' => 1,
            'color' => '#0000ff',
            'image' => null,
            'body' => 'Tips dan trik PHP masa kini.',
            'tags' => ['php', 'tips'],
            'published' => true,
            'published_at' => now(),
        ]);
    }
}
