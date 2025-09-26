<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <title>Mensaje</title>
  </head>
  <body>
    <h2>¡Hola {{ $user->name }}!</h2>
    <p>{{ $contentMessage }}</p>
    <p>
      Saludos,
      <br />
      El equipo de {{ config('app.name') }}
      <p>Bienvenido a nuestra plataforma! Estamos encantados de tenerte con nosotros.</p>
    </p>
  </body>
</html>