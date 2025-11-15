<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Warehouse;

class WarehouseSeeder extends Seeder
{
    public function run(): void
    {
        Warehouse::create(['name' => 'Gudang Makassar', 'location' => 'Jl. Perintis Kemerdekaan']);
        Warehouse::create(['name' => 'Gudang Gowa', 'location' => 'Jl. Sultan Hasanuddin']);
        Warehouse::create(['name' => 'Gudang Maros', 'location' => 'Jl. Poros Maros']);
    }
}
