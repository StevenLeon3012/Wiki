<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Blog extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        'user_id' ,'title', 'body', 'category_id', 'status_id'
    ];
    
    //Relacion uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function status(){
        return $this->belongsTo(Status::class);
    }
    
    //Relacion muchos a muchos
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
    
    //Relacion uno a muchos
    public function records() {
        return $this->hasMany(Record::class);
    }
    
    //Relacion uno a uno Polimorfica
    public function image() {
        return $this->morphOne(Image::class, 'imageable');
    }
}