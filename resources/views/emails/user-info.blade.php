<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <title>Mensaje</title>
  </head>
  <body style="font-family: Arial, sans-serif; color:#333;">
    <h2>Hola {{ $user->name }}</h2>

    <hr>
    <p>
      Saludos,
      <br />
      El equipo de {{ config('app.name') }}
      <p>Bienvenido a nuestra plataforma! Estamos encantados de tenerte con nosotros.</p>
    </p>
    
    <p style="font-size: 0.9em; color: #666;">
      Este mensaje fue enviado por: <br>
      <strong>{{ $senderName }}</strong> ({{ $senderEmail }})
    </p>
  </body>
</html>