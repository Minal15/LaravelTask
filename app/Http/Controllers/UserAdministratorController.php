<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAdministratorController extends Controller
{

    public function login(LoginRequest $request)
    {
        $request->validated();

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return response()->json(['message' => 'Login successful']);
            } else {
                Auth::logout();
                return response()->json(['error' => 'You are not authorized to access this resource'], 403);
            }
        }
        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $data =$request->validated();
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        $user = User::create($data);
        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
