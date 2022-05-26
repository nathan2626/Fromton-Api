<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cheese extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'subtitle', 'description', 'pound', 'milk', 'refining', 'pate', 'wine', 'img', 'price', 'category', 'category_id'];
}
