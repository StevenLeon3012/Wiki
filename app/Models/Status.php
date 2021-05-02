<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model {
    protected $table = 'status';
    use HasFactory;
    
    //Relacion uno a muchos
    public function blogs() {
        return $this->hasMany(Blog::class);
    }
    
}
