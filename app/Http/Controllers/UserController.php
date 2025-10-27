<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view users')->only(['index', 'show']);
        $this->middleware('permission:create users')->only(['create', 'store']);
        $this->middleware('permission:edit users')->only(['edit', 'update']);
        $this->middleware('permission:delete users')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::with('permissions')
             ->whereNull('deleted_at')
             ->get();
        
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();
        try {
            // Crear usuario con fill y hash de contraseña
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:6',
        'role' => 'required|string|exists:roles,name', // 👈 el rol debe existir
    ]);
        // Guardar usuario
        $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
    ]);
        // Asignar rol
        $user->assignRole($validated['role']);

        // Confirmar transacción
        DB::commit();

        // Redirigir con mensaje de éxito
        return redirect()->route('users.index')
                         ->with('success', 'Usuario creado correctamente.');

        } catch (\Exception $e) {
            DB::rollBack();
                   
        return redirect()->back()
                         ->withInput()
                         ->with('error', 'Ocurrió un error al crear el usuario. Por favor intenta nuevamente.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));//
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::with('permissions')
             ->whereNull('deleted_at')
             ->get();
        
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
{
    $request->validate([
        'role' => 'required|exists:roles,name',
    ]);

    // 🔹 Rellenar los atributos permitidos
    $user->fill($request->only(['name', 'email']));

    // 🔹 Verificar si hay cambios en los atributos
    $hasChanges = $user->isDirty();

    // 🔹 Verificar si se envió password
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
        $hasChanges = true;
    }

    // 🔹 Verificar si el rol cambió
    if (!$user->hasRole($request->role)) {
        $user->syncRoles([$request->role]);
        $hasChanges = true;
    }

    // 🔹 Guardar solo si hubo cambios
    if ($hasChanges) {
        $user->save();
    }

    return redirect()->route('users.index')
        ->with('success', $hasChanges
            ? 'Usuario actualizado correctamente.'
            : 'No se detectaron cambios.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
