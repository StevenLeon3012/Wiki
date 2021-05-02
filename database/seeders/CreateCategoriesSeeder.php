<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CreateCategoriesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Category::create(['type_category' => 'Programación']);
        Category::create(['type_category' => 'Bases de Datos']);
        Category::create(['type_category' => 'Redes']);
    }
    
}
