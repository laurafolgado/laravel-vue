<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produktu;

class ProduktuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Genera 25 productos de ejemplo
        Produktu::factory(25)->create();
    }
}
