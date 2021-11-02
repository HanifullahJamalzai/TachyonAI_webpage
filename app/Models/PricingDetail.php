<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PricingDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'price', 'duration', 'description', 'slug'];

    public function getRouteKeyName(){
        return 'slug';
    }
}
