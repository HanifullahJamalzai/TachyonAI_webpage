<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SkillProgress extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['progressbar_title', 'percentage', 'slug'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
