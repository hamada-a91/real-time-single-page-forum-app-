<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $quarded = []; // ich kann ignoriere some mass assigment
    protected $fillable = ['name', 'slug'];


    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
