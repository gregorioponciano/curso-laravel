<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function auth(Request $request) {
        $credenciais = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'O campo email e obrigatorio!',
            'email.email' => 'O email não é valido',
            'password.required' => 'O campo password e obrigatorio!',
        ]);
        if (Auth::attempt($credenciais)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard'); // intended volta para a rota do carrinho por exemplo quando o usuario nao esta autentificado
        }
        else {
            return redirect()->back()->with('erro', 'email ou senha invalido.');
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session->invalidate();
        $request->session->regenerateToken();
        return redirect(route('site.index'));

    }
}
