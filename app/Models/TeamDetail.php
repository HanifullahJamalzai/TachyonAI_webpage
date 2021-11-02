<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
class TeamDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['full_name', 'position', 'bio', 'fb', 'twitter', 'instagram', 'linkedin', 'photo', 'slug'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
