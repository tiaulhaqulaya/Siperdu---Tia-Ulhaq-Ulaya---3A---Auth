<?php
 
namespace Database\Seeders;
use Illuminate\Database\Seeder;
 
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Urutan penting: kategori harus ada sebelum buku
        $this->call([
            UserSeeder::class,
            KategoriSeeder::class,
            BukuSeeder::class,
        ]);
    }
}