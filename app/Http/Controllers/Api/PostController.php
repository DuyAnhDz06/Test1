<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function index()
    {
        $user = User::latest()->get();
        return response()->json([
            'success'=> true,
            'message'=>'List data user',
            'data' => $user
        ],200);

    }

    public function create()
    {
  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content'=> 'required'
        ]);
        $user = User::create([
            'title' => $request->title,
            'content'=> $request->content
        ]);
        return response()->json([
            'success'=> true,
            'message'=>'User created',
            'data' => $user
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json([
            'success'=> true,
            'message'=>'Detail data user',
            'data' => $user
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content'=> 'required'
        ]);
        $user = User::find($user->id);
        if($user){
            $user->update([
                'title' => $request->title,
                'content'=> $request->content
            ]);
            return response()->json([
                'success'=> true,
                'message'=>'User updated',
                'data' => $user
            ],200);
        }
        return response()->json([
            'success'=> false,
            'message'=>'User not found',
            
        ],404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if($user){
            $user->delete();
            return response()->json([
                'success'=> true,
                'message'=>'User deleted',
                'data' => $user
            ],200);
        }
        return response()->json([
            'success'=> false,
            'message'=>'User not found',
            
        ],404);
    }
}
