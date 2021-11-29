<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    public function BlogPost() {
        return $this->belongsTo('App\Models\BlogPost');    
    }
    protected $fillable = ['content','blog_post_id'];
}
