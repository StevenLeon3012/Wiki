<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class CreateTagsSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
         Tag::create(['tag' => 'Urgente']);
         Tag::create(['tag' => 'Baja Prioridad']);
         Tag::create(['tag' => 'Frontend']);
         Tag::create(['tag' => 'Backend']);
    }
    
}
