<?php

namespace App\Http\Controllers;

use App\Models\Cheese;
use Illuminate\Http\Request;

class CheeseController extends Controller
{
    public function index()
    {
        $cheeses = Cheese::all();
        
        //$tasksUser = auth()->user()->tasks()->orderBy('updated_at', 'desc')->get();
        
        return response()->json([
            'cheeses'=>$cheeses
        ], 200);

    }

    public function show($id)
    {
        $cheese = Cheese::find($id);
        if(!$cheese) {
            return response()->json(["message" => "Les souris ont mangé tout ce fromage.."],404);
        }
        return response()->json([
            'cheese' => $cheese
        ], 200);
    }

}
