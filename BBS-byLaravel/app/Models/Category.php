<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //允许批量赋值
    protected $fillable = [
        'name', 'description',
    ];


}
