<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $table='themes';

    protected $fillable=['title','theme','username'];
}
