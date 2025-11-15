<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Warehouse;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $category1 = Category::where('name', 'Elektronik')->first();
        $category2 = Category::where('name', 'Pakaian')->first();

        $wh1 = Warehouse::where('name', 'Gudang Makassar')->first();
        $wh2 = Warehouse::where('name', 'Gudang Gowa')->first();

        if (!$category1 || !$wh1) {
            $this->command->error('Pastikan CategorySeeder dan WarehouseSeeder dijalankan lebih dulu.');
            return;
        }

        DB::transaction(function () use ($category1, $category2, $wh1, $wh2) {
            // Laptop
            $p1 = Product::create([
                'name' => 'Laptop ASUS VivoBook',
                'price' => 8500000,
                'category_id' => $category1->id,
            ]);
            $p1->detail()->create([
                'description' => 'Laptop 15 inch, RAM 8GB, SSD 512GB.',
                'weight' => 1.5,
                'size' => '15 inch'
            ]);
            $p1->warehouses()->attach([
                $wh1->id => ['quantity' => 12],
                $wh2->id => ['quantity' => 6],
            ]);

            // Kaos Polos
            $p2 = Product::create([
                'name' => 'Kaos Polos Hitam',
                'price' => 80000,
                'category_id' => $category2->id,
            ]);
            $p2->detail()->create([
                'description' => 'Kaos cotton combed 30s ukuran L.',
                'weight' => 0.2,
                'size' => 'L'
            ]);
            $p2->warehouses()->attach([
                $wh1->id => ['quantity' => 25],
                $wh2->id => ['quantity' => 40],
            ]);
        });
    }
}
