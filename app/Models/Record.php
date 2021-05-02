<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        'modifier' ,'type', 'modificated', 'description'
    ];

    //Relacion uno a muchos inversa
    public function blog(){
        return $this->belongsTo(Blog::class);
    }
}
