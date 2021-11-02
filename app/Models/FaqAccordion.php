<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FaqAccordion extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable  = ['question', 'answer', 'slug'];

    public function getRouteKeyName(){
        return 'slug';
    }
}
