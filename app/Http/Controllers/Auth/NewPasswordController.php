<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\User; // Asegúrate de importar el modelo User

class NewPasswordController extends Controller
{
   /**
    * Display the password reset view.
    */
   public function create(Request $request): View
   {
      return view('auth.reset-password', ['request' => $request]);
   }

   /**
    * Handle an incoming new password request.
    *
    * @throws \Illuminate\Validation\ValidationException
    */
   public function store(Request $request): RedirectResponse
   {
      // Cambiar la validación para utilizar 'username' en vez de 'email'
      $request->validate([
         'token' => ['required'],
         'username' => ['required', 'string'], // Validar el nombre de usuario
         'password' => ['required', 'confirmed', Rules\Password::defaults()],
      ]);

      // Intentar encontrar al usuario mediante el nombre de usuario
      $user = User::where('username', $request->username)->first();

      if (!$user) {
         return back()->withErrors(['username' => __('auth.user_not_found')]); // Mensaje de error personalizado
      }

      // Aquí intentamos restablecer la contraseña del usuario. Si es exitoso, actualizaremos
      // la contraseña en el modelo del usuario y la persistiremos en la base de datos.
      $status = Password::reset(
         [
            'username' => $request->username,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
            'token' => $request->token,
         ],
         function ($user) use ($request) {
            $user->forceFill([
               'password' => Hash::make($request->password),
               'remember_token' => Str::random(60),
            ])->save();

            event(new PasswordReset($user));
         }
      );

      // Si la contraseña fue restablecida con éxito, redirigimos al usuario a la vista de login.
      return $status == Password::PASSWORD_RESET
         ? redirect()->route('login')->with('status', __($status))
         : back()->withInput($request->only('username')) // Cambiar 'email' por 'username'
         ->withErrors(['username' => __($status)]);
   }
}
