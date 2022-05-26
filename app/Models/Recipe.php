<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'nbrpers', 'difficult', 'time', 'cook', 'ingredients', 'steps', 'img', 'img', 'cheese_name', 'cheese_id'];

}
