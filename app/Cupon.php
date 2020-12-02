<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Cupon extends Model
{
    protected $table = 'cupon';
    protected $fillable = ['id', 'user_email', 'token'];

}