<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceBox extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['icon', 'title', 'description', 'slug'];

    public function getRouteKeyName(){
        return 'slug';
    }
}
