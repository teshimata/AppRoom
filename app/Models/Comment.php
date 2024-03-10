<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    use HasFactory;
        
    protected $fillable = [
        'body',
        'user_id',
        'post_id',
        'comment_id'
    ];
    
    public function post()   
    {
        return $this->belongsTo(Post::class);  
    }
}
