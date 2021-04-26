<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Comment extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        'user_id' , 'blog_id', 'body',
    ];
    
    //Relacion uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Relacion uno a muchos inversa
    public function blog() {
        return $this->belongsTo(Blog::class);
    }
}