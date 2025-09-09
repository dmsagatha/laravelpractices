<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Illuminate\Http\Request;

class ImageController extends Controller
{
  public function fileUpload()
  {
    return view('dashboard');
  }

  /**
   * Laravel 11 Image Intervention Tutorial: Resize and Crop Image Like a Boss
   * https://www.youtube.com/watch?v=f2WNXpEPtKk
   */
  public function storeImage(Request $request)
  {
    $request->validate([
      'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Obtener el archivo cargado
    $image = $request->file('avatar');

    // Generar nombre único para la imagen
    $imageName = time() . '.' . $image->getClientOriginalExtension();

    // Cargar imagen en el directorio public/uploads
    $image->move('uploads', $imageName);

    // Crear una nueva instancia con el controlador deseado
    $imgManager = new ImageManager(new Driver());

    // Leer la imagen cargada desde el sistema local (uploads)
    $thumbImage = $imgManager->read('uploads/' . $imageName);

    // Redimensionar la imagen usando Intervention
    // $thumbImage->resize(250, 250);
    $thumbImage->cover(250, 250);

    // Guardar la imagen redimensionada en un directorio diferente
    $response = $thumbImage->save(public_path('uploads/thumbnails/' . $imageName));

    // Almacenar la información de la imagen en la base de datos
    if ($response) {
      return back()->with('success', 'Imagen cargada y dimensionada exitosamente!')->with('image', $imageName);
    }
    return back()->with('error', 'Error al cargar y dimensionar la imagen');

    // dd($imageName, $request->avatar);
  }
}