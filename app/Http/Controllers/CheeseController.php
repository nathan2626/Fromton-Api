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

}
