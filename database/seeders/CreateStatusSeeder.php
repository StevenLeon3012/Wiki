<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class CreateStatusSeeder extends Seeder {
        
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Status::create(['status' => 'Pendiente']);
        Status::create(['status' => 'Resuelto']);
    }
    
}
