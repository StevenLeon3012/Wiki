<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog_Type;

class CreateBlogTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Blog_Type::create(['type' => 'Blog Informativo']);
        Blog_Type::create(['type' => 'Blog de Pregunta']); 
    }
}
