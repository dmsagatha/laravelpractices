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
    $data = $request->validated();

    if ($request->hasFile('avatar')) {
      // Obtener el archivo cargado
      $imageFile = $request->file('avatar');

      // Storage:Crear directorio, guardar y eliminar archivos el directorio si no existe
      Storage::disk('public')->makeDirectory('avatars');

      // Generar un nombre único para el archivo
      $imageName = 'avatars/' . time() . '.' . $imageFile->getClientOriginalExtension();

      // Intervention Image v3: Leer, procesar y exportar imágenes
      $manager = new ImageManager(new Driver());
      $image = $manager->read($imageFile);

      // Redimensiona a 300x300 (centrado y cortado) y exportar como JPG 
      $resized = $image->cover(300, 300)->toJpeg(80);

      // Guardar en storage/app/public/avatars
      // Storage::disk('public')->put($imageName, (string) $image->encode());
      Storage::disk('public')->put($imageName, $resized);

      // Guardar la ruta en la BD
      $data['avatar'] = $imageName;
    }

    // Guardar contraseña encriptada
    $data['password'] = Hash::make($data['password']);

    $response = User::create($data);
    
    if ($response) {
      return redirect()->route('users.index')->with('success', 'Usuario creado correctamente!');
    }
    return redirect()->back()->with('error', 'Error al crear el usuario');
  }

  public function show(User $user)
  {}
  
  public function edit(User $user)
  {
    return view('backend.users.createUpdate', compact('user'));
  }
  
  public function update(UserRequest $request, User $user)
  {
    $data = $request->validated();

    // Procesar avatar si llega nuevo archivo
    if ($request->hasFile('avatar')) {
      // Eliminar avatar anterior si existe
      if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
        Storage::disk('public')->delete($user->avatar);
      }
      
      // Obtener el archivo cargado
      $imageFile = $request->file('avatar');

      // Generar un nombre único para el archivo
      $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
      $imagePath = 'avatars/' . $imageName;

      // Crear directorio si no existe
      if (!Storage::disk('public')->exists('avatars')) {
        Storage::disk('public')->makeDirectory('avatars');
      }

      // Intervention Image v3: Leer, procesar y exportar imágenes
      $manager = new ImageManager(new Driver());
      $image = $manager->read($imageFile->getRealPath());

      // Redimensionar (ejemplo: 300x300, proporcional)
      $image->scale(width: 300);    // cover(width, height)

      // Guardar en storage/app/public/avatars
      $image->toJpeg(80)->save(storage_path('app/public/' . $imagePath));

      // Guardar la ruta en la BD
      $data['avatar'] = $imagePath;
    }
    // Quitar avatar si se marcó "remove_avatar"
    elseif ($request->boolean('remove_avatar')) {
      if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
        Storage::disk('public')->delete($user->avatar);
      }
      $data['avatar'] = null;
    }
    // Mantener avatar existente
    else {
      unset($data['avatar']);
    }

    // Si no se envía la contraseña, no hay cambios
    if (!empty($data['password'])) {
      $data['password'] = Hash::make($data['password']);
    } else {
      unset($data['password']);
    }

    // Quitar avatar sin subir uno nuevo
    /* if ($request->boolean('remove_avatar')) {
      if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
        Storage::disk('public')->delete($user->avatar);
      }
      $data['avatar'] = null;
    }

    // Subir nueva imagen
    if ($request->hasFile('avatar')) {
      // Obtener el archivo cargado
      $imageFile = $request->file('avatar');

      // Generar un nombre único para el archivo
      $fileName = time() . '.' . $imageFile->getClientOriginalExtension();

      // Intervention Image v3: Leer, procesar y exportar imágenes
      $manager = new ImageManager(new Driver());
      $image = $manager->read($imageFile);

      // Redimensionar y exportar como JPG
      $resized = $image->cover(300, 300)->toJpeg(80);

      // Storage:Crear directorio, guardar y eliminar archivos el directorio si no existe
      Storage::disk('public')->makeDirectory('avatars');

      // Eliminar imagen anterior si existe
      if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
        Storage::disk('public')->delete($user->avatar);
      }

      // Guardar la nueva imagen en storage/app/public/avatars
      Storage::disk('public')->put("avatars/{$fileName}", $resized);

      // Guardar la ruta en la BD
      // $data['avatar'] = "avatars/{$fileName}";
      $data['avatar'] = $imageFile->store('avatars', 'public');
    }

    // Si no se envía contraseña, no hay cambios
    if (!empty($data['password'])) {
      $data['password'] = Hash::make($data['password']);
    } else {
      unset($data['password']);
    } */

    $response = $user->update($data);

    if ($response) {
      return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente!');
    }
    return redirect()->back()->with('error', 'Error al actualizar el usuario');
  }
  
  public function destroy(User $user)
  {}
}