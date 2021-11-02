<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PortfolioDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'type', 'photo', 'slug'];

    public function getRouteKeyName(){
        return 'slug';
    }
}
