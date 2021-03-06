<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog_Type extends Model {
    protected $table = 'blog_type';
    use HasFactory;

    //Relacion uno a muchos
    public function blogs() {
        return $this->hasMany(Blog::class);
    }
    
}
