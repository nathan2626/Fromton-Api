<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories_cheese extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'img'];

}
