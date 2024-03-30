<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'body',
        'link_url',
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comment()   
    {
        return $this->hasMany(Comment::class);  
    }
    
    public function likes(){
        return $this->hasMany(Like::class);
    }
    
    public function images()
    {
        return $this->hasMany(PostImage::class);
    }
    
    public function links()
    {
        return $this->hasMany(PostLink::class);
    }
    
    public function getPaginateByLimit(int $limit_count = 10)
    {
        return $this::with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
