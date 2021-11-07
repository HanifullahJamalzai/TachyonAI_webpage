<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['comment_id','description', 'fb_id', 'twitter_id', 'github_id', 'linkedin_id', 'google_id'];
    
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
