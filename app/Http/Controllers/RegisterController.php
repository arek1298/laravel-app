<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        $userData = $request->only('name', 'email', 'password');
        $userData['password'] = bcrypt($userData['password']);

        $user = User::create($userData);

        // Verifica si el correo electrónico del usuario es de administrador
        if ($this->isAdminEmail($user->email)) {
            $user->update(['role' => 'admin']);
            auth()->login($user);

            // Redirige a la pestaña para administradores
            return redirect()->route('admin.dashboard');
        } else {
            auth()->login($user);
            return redirect()->to('/');
        }
    }

    /**
     * Verifica si el correo electrónico es de administrador.
     *
     * @param string $email
     * @return bool
     */
    private function isAdminEmail($email)
    {
        return $email === 'admin@example.com';
    }
}
