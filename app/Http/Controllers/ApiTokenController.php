<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ApiTokenController extends Controller
{

    public function register(Request $request)
    {
        //1 - form validation
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        //2 check if user exist
        $exists = User::where('email', $request->email)->exists();
        if($exists){
            return response()->json([
                'error'=>"You are already registered"
            ], 409);
        }

        // 3 create user
        $user = User::create([
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'name'=> $request->name
        ]);

        //4 create auth token
        $token = $user->createToken($request->device_name, ['tasks:write', 'tasks:read'])->plainTextToken;

        //5 return data
        return response()->json([
            'token'=> $token,
            'email'=>$user->email,
            'name'=> $user->name,
            "created_at"=> $user->created_at
        ], 201);

    }

    public function login(Request $request)
    {
        //1 - form validation
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                "error"=> "The provided credentials are incorrect."
            ], 401);
//            throw ValidationException::withMessages([
//                'email' => ['The provided credentials are incorrect.'],
//            ]);
        }

        //3 - clear old tokens
        $user->tokens()->where('tokenable_id', $user->id)->delete();

        //4 - create other token
        $token = $user->createToken($request->device_name, ['tasks:write', 'tasks:read'])->plainTextToken;

        return response()->json([
            'token'=> $token,
            'email'=>$user->email,
            'name'=> $user->name,
            'created_at'=> $user->created_at,
        ], 200);


    }

    public function me (Request $request)
    {

        return response()->json([
            'email'=>$request->user()->email,
            'name'=> $request->user()->name,
            "created_at"=> $request->user()->created_at,
            "updated_at"=> $request->user()->updated_at,
            "id"=> $request->user()->id

        ], 200);

    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message'=>"You are disconnected"
        ], 200);
    }

     /**
     * @OA\Get(
     *      path="/v1/countries",
     *      operationId="getAllCountrie",
     *      tags={"Tests"},

     *      summary="Get List Of Countries",
     *      description="Returns all countries and associated provinces. The country_slug variable is used for country specific data",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */


}
