<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Support\Facades\Notification;

class Inbox extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'subject', 'message', 'status', 'slug'];


    public function getRouteKeyName()
    {
        return 'slug';
    }

    // public function routeNotificationForNexmo($notification)
    // {
    //     return '+93779636360';
    //     // return '+93744759724';
    // }

}
