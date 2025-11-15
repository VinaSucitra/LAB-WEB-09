<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['name' => 'Elektronik', 'description' => 'Produk elektronik seperti laptop dan handphone.']);
        Category::create(['name' => 'Pakaian', 'description' => 'Fashion dan aksesoris.']);
        Category::create(['name' => 'Makanan', 'description' => 'Makanan ringan dan minuman.']);
    }
}
