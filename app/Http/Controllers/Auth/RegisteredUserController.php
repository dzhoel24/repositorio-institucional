<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
   /**
    * Display the registration view.
    */
   public function create(): View
   {
      return view('auth.register');
   }

   /**
    * Handle an incoming registration request.
    *
    * @throws \Illuminate\Validation\ValidationException
    */
   public function store(Request $request): RedirectResponse
   {
      $request->validate([
         'name' => ['required', 'string', 'max:255'],
         'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
         'password' => ['required', 'confirmed', Rules\Password::defaults()],
         'profile_photo' => ['nullable', 'image', 'max:2048'], // Validación para la imagen
      ]);

      // Almacenar la foto de perfil en 'storage/app/profile' y obtener el nombre original del archivo
      $profilePhotoName = null;
      if ($request->hasFile('profile_photo')) {
         $profilePhotoName = $request->file('profile_photo')->getClientOriginalName(); // Obtener el nombre original del archivo
         $request->file('profile_photo')->storeAs('profile', $profilePhotoName); // Mover el archivo al directorio
      }

      $user = User::create([
         'name' => $request->name,
         'username' => $request->username,
         'password' => Hash::make($request->password),
         'profile_photo' => $profilePhotoName, // Guardar solo el nombre original del archivo
      ]);

      event(new Registered($user));

      Auth::login($user);

      return redirect(route('home'));
   }
}
