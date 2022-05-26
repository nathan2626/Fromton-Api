<?php

namespace App\Http\Controllers;

use App\Models\Categories_cheese;
use Illuminate\Http\Request;

class CategoryCheeseController extends Controller
{
    public function index()
    {
        $categories = Categories_cheese::all();
        
        
        return response()->json([
            'categories'=>$categories
        ], 200);

    }

    public function show($id)
    {
        $category = Categories_cheese::find($id);
        if(!$category) {
            return response()->json(["message" => "La catégorie n'éxiste pas.."],404);
        }
        return response()->json([
            'category' => $category
        ], 200);
    }
}
