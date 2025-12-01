<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Show admin dashboard with all users
    public function index()
    {
        $users = User::all(); // Get all users
        return view('admin.index', compact('users'));
    }

    // Show form to create a new user
    public function create()
    {
        return view('admin.create');
    }

    // Store a new user
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6',
            'role'=>'required|in:admin,teacher,student',
        ]);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>$request->role
        ]);

        return redirect()->route('admin.index')->with('success','User created!');
    }
}
