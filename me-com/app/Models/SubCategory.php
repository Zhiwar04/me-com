<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
class SubCategory extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
