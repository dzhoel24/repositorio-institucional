<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',        // Campo de nombre completo
        'username',         // Campo de nombre de usuario
        'password',         // Contraseña
        'profile_photo', // Ruta de la foto de perfil
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',         // Ocultar contraseña
        'remember_token',   // Ocultar token de recordatorio
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            // Se eliminó 'email_verified_at' porque ya no se usa
            'password' => 'hashed', // Mantener el hash para la contraseña
        ];
    }

    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo
            ? asset('storage/profile/' . $this->profile_photo)
            : asset('images/default.png');
    }
}
