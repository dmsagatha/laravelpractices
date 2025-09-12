<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Illuminate\Support\Facades\Storage;
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
    // dd($request->all());

    if ($request->hasFile('avatar')) {
      // Storage:Crear directorio, guardar y eliminar archivos el directorio si no existe
      Storage::disk('public')->makeDirectory('avatars');

      // Obtener el archivo cargado
      $imageFile = $request->file('avatar');

      // Intervention Image v3: Leer, procesar y exportar imágenes
      $manager = new ImageManager(new Driver());
      $image = $manager->read($imageFile);

      // Generar un nombre único para el archivo
      $imageName = 'avatars/' . time() . '.' . $imageFile->getClientOriginalExtension();

      // Guardar en storage/app/public/avatars
      Storage::disk('public')->put($imageName, (string) $image->encode());

      // Guardar la ruta en la BD
      $data['avatar'] = $imageName;
    }

    // Guardar contraseña encriptada
    $data['password'] = Hash::make($request->password);

    $response = User::create($data);
    
    if ($response) {
      return redirect()->route('users.index')->with('success', 'Usuario creado correctamente!');
    }
    return redirect()->back()->with('error', 'Error al crear el usuario');
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