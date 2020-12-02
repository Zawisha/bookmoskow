<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class EmailsDb extends Model
{
    protected $table = 'emailsdb';
    protected $fillable = ['id', 'user_email', 'token', 'unsubed'];
}
