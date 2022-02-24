<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'code', 'author', 'edition' , 'status' , 'publish'
    ];

     public function subcategories(){
        return $this->hasMany('App\Category', 'parent_id');
    }

   public function BookData()
    {
        return $this->hasOne('App\Models\Stock');
    }
}