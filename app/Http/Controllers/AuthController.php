<?php

namespace App\Http\Controllers;

use App\Mail\TwoFactorCode;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        // Validar datos básicos
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = Staff::where('email', $credentials['email'])->first();

        // Verificar si el usuario existe y la contraseña es correcta
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['credentials' => 'Las credenciales introducidas son incorrectas']);
        }
        $code = rand(100000, 999999);
        $user->code = Hash::make($code);
        $user->save();

        Mail::to($user->email)->send(new TwoFactorCode($user, $code));

        return redirect()->route('factor', ['user' => $user->staff_id]);
    }

    public function factor(Staff $user)
    {
        return view('codigo',['user' => $user]);
    }

    public function twofa(Request $request, Staff $user)
    {
        $request->validate([
            'code' => 'required|numeric',
        ]);

        if ($user && Hash::check($request->code, $user->code)) {
            $user->code = null;
            $user->save();
            Auth::login($user);
            return redirect()->route('dashboard');
        }
        return back()
            ->withErrors(['code' => 'El código introducido es incorrecto']);
    }


    public function resendCode(Staff $user)
    {
        // Generar nuevo código
        $code = rand(100000, 999999);
        $user->code = Hash::make($code);
        $user->save();
        
        // Enviar el código por correo
       
        Mail::to($user->email)->send(new TwoFactorCode($user, $code));
         
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $user = Staff::where('email', $request->email)->first();
        $code = rand(100000, 999999);
        $user->code = Hash::make($code);
        $user->save();
        Mail::to($user->email)->send(new TwoFactorCode($user, $code));

        if (!$user) {
            return back()->withErrors(['credentials' => 'No se encontró un usuario con ese correo electrónico.']);
        }
        return redirect()->route('2fapassword', ['user' => $user->staff_id]);
        
    }

    public function show2fapassword(Staff $user)
    {
        return view('codigopassword', ['user' => $user]);
    }


    public function showchangepassword(Staff $user)
    {
        return view('changepassword', ['user' => $user]);
    }

    public function twofapassword(Request $request, Staff $user)
    {
        $request->validate([
            'code' => 'required|numeric',
        ]);

        if ($user && Hash::check($request->code, $user->code)) {
            $user->code = null;
            $user->save();
            return redirect()->route('showpassword', ['user' => $user->staff_id]);
        }
        return back()
            ->withErrors(['code' => 'El código introducido es incorrecto']);
    }

    public function updatePassword(Request $request, Staff $user)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Contraseña actualizada con éxito.');
    }

}
