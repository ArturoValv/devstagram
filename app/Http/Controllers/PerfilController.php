<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PerfilController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        //Modificar el Request
        $request->request->add(['username' => Str::slug($request->username)]);

        //Validacion
        $request->validate([
            'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter,editar-perfil'],
            'email' => ['required', 'unique:users,email,' . auth()->user()->id, 'max:60'],
            /* 'password' => ['confirmed', 'min:6'], */
            'current_password' => 'required',
        ]);

        if ($request->imagen) {
            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid() . '.' . $imagen->extension();

            $manager = new ImageManager(new Driver());

            $imagenServidor = $manager->read($imagen);

            $imagenServidor->cover(1000, 1000);

            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;

            $imagenServidor->save($imagenPath);
        }

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }

        //Guardar los cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        /* $usuario->password = Hash::make($request->password); */

        $usuario->save();

        //Redireccionar
        return redirect()->route('posts.index', $usuario->username);
    }
}
