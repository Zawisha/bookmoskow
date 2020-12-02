<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class DropCart extends Model
{
    //local
//    protected $table = 'DropCart';
//    prod
    protected $table = 'DropCart';
    protected $fillable = ['id', 'user_id', 'user_email', 'user_name', 'good_id', 'good_name', 'good_image'];
}
