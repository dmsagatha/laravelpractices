<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserMessageMail;
use App\Mail\UsersMail;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EmailsController extends Controller
{
  public function indexsendMessage()
  {
    $users = User::orderBy('name')->paginate(10);
    return view('backend.users.emails', compact('users'));
  }

  // Envío de correos masivo a usuarios con formato de datos Blade - Manejo de errores
  public function send(Request $request)
  {
    // dd($request->all());

    $request->validate([
      'users'   => ['required', 'array'],
      'message' => ['required', 'string', 'max:5000'],
    ]);

    try {
      $sender = Auth::user();
      $users = User::whereIn('id', $request->users)->get();

      foreach ($users as $user) {
        Mail::to($user->email)->send(
          new UsersMail($user, $request->message, $sender->name, $sender->email)
        );
      }

      return back()->with('success', 'Mensajes enviados correctamente ✅');
    } catch (\Exception $e) {
      return back()->with('error', 'Error al enviar los mensajes ❌ -> ' . $e->getMessage());
    }
  }
  
  // Envío de correos masivo a usuarios con recuadro de texto
  public function sendMessage(Request $request)
  {
    // Admin - SuperAdmin
    /* $request->validate([
    'users'   => ['required', 'array', 'min:1'],
    'message' => ['required', 'string', 'max:1000'],
    ]);

    $userIds = $request->input('users', []);
    $users   = User::whereIn('id', $userIds)->get();

    foreach ($users as $user) {
    Mail::to($user->email)->send(new UserMessageMail($user, $request->message));
    }

    return back()->with('success', 'Mensaje enviado a los usuarios seleccionados.'); */

    // Usuario autenticado
    $request->validate([
      'users'   => ['required', 'array', 'min:1'],
      'message' => ['required', 'string', 'max:1000'],
    ]);

    $sender = Auth::user();
    $users = User::whereIn('id', $request->input('users', []))->get();

    foreach ($users as $user)
    {
      Mail::to($user->email)->send(
        new UserMessageMail(
          $user,
          $request->message,
          $sender->name, // Nombre del remitente
          $sender->email
        )
      );
    }

    return back()->with('success', 'Mensajes enviados correctamente.');
  }


  public function welcomeEmail()
  {
    Mail::to('recipent@example.com')->send(new WelcomeMail());
    return 'Correo electrónico de bienvenida enviado!';
  }
}