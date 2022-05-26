<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::all();
        
        //$tasksUser = auth()->user()->tasks()->orderBy('updated_at', 'desc')->get();
        
        return response()->json([
            'recipes'=>$recipes
        ], 200);

    }

    public function show($id)
    {
        $recipe = Recipe::find($id);
        if(!$recipe) {
            return response()->json(["message" => "La recette n'éxiste pas.."],404);
        }
        return response()->json([
            'recipe' => $recipe
        ], 200);
    }
}
