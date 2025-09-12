<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index()
  {
    $users = User::latest()->paginate(10);
    return view('backend.users.index', compact('users'));
  }
  
  public function create()
  {
    return view('backend.users.createUpdate');
  }
  
  public function store(UserRequest $request)
  {
    /* $request->validate([
      'name'  => 'required|string|max:255',
      'email' => 'required|email|unique:users,email',
      'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]); */

    $data = $request->validated();
    $data = $request->only('name', 'email');
    $data['password'] = Hash::make($request->password);
    // dd($request->all());
  }

  public function edit(User $user)
  {
    return view('backend.users.createUpdate', compact('user'));
  }
  
  public function update(Request $request, User $user)
  {}
  
  public function show(User $user)
  {}
  
  public function destroy(User $user)
  {}
}