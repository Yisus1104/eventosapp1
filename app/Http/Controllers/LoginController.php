<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|digits_between:10,15',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'email.unique' => 'El correo ya está registrado.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'phone.required' => 'El número de teléfono es obligatorio.',
            'phone.digits_between' => 'Ingresa un número de teléfono valido.',
        ]);
        
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'usuario',
        ]);
        
        Auth::login($user);
        return redirect()->route('eventos')->with('success', 'Registro exitoso, bienvenido!');
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Por favor ingresa tu correo electrónico.',
            'email.email' => 'Por favor ingresa un correo electrónico válido.',
            'password.required' => 'Por favor ingresa tu contraseña.',
        ]);
    
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');
    
        if (Auth::attempt($credentials, $remember)) {
            // Regenerar sesión para prevenir fijación de sesión
            $request->session()->regenerate();
            
            // Redirigir según el rol del usuario
            if (Auth::user()->role === 'admin') {
                return redirect()->route('eventos')->with('success', 'Inicio de sesión exitoso.');
            } else {
                return redirect()->route('eventos')->with('success', 'Inicio de sesión exitoso.');
            }
        }
    
        // Si las credenciales son incorrectas
        return back()
            ->withErrors(['email' => 'Las credenciales no son correctas.'])
            ->withInput($request->only('email', 'remember'));
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        
        // Invalidar sesión y regenerar token
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')->with('success', 'Has cerrado sesión correctamente.');
    }

    public function indexUsuarios()
{
    $users = User::all();
    return view('usuarios', compact('users'));
}

public function storeUsuario(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|digits_between:10,15',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|in:usuario,admin',
    ], [
        'email.unique' => 'El correo ya está registrado.',
        'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        'password.confirmed' => 'Las contraseñas no coinciden.',
        'phone.required' => 'El número de teléfono es obligatorio.',
        'phone.digits_between' => 'Ingresa un número de teléfono válido.',
        'role.required' => 'El rol es obligatorio.',
        'role.in' => 'El rol seleccionado no es válido.',
    ]);
    
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password),
        'role' => $request->role,
    ]);
    
    return redirect()->route('usuarios')->with('success', 'Usuario creado correctamente');
}

public function updateUsuario(Request $request, $id)
{
    $user = User::findOrFail($id);
    
    $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,'.$id,
        'phone' => 'required|digits_between:10,15',
        'role' => 'required|in:usuario,admin',
    ];
    
    // Solo validar la contraseña si se proporcionó
    if ($request->filled('password')) {
        $rules['password'] = 'required|string|min:8|confirmed';
    }
    
    $request->validate($rules);
    
    $userData = [
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'role' => $request->role,
    ];
    
    // Actualizar la contraseña solo si se proporcionó
    if ($request->filled('password')) {
        $userData['password'] = Hash::make($request->password);
    }
    
    $user->update($userData);
    
    return redirect()->route('usuarios')->with('success', 'Usuario actualizado correctamente');
}

public function destroyUsuario($id)
{
    $user = User::findOrFail($id);
    
    // Evitar que un administrador se elimine a sí mismo
    if ($user->id === auth()->id()) {
        return redirect()->route('usuarios')->with('error', 'No puedes eliminar tu propia cuenta');
    }
    
    $user->delete();
    
    return redirect()->route('usuarios')->with('success', 'Usuario eliminado correctamente');
}
}