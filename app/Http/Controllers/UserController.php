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
        $roles = Role::all(); 
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
            $user = new User();
            $user->fill([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        // Guardar usuario
        $user->save();
        // Asignar rol
        $user->assignRole($request->role);

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
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // Asignar solo los campos proporcionados
        $user->fill($request->only(['name', 'email']));

        // Detectar cambios importantes
        if ($user->isDirty('email')) {
            // Aquí puedes disparar eventos o notificaciones
            // Ej: event(new UserEmailChanged($user));
        }

        // Actualizar la contraseña solo si viene en el request
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Guardar cambios en la base de datos
        $user->save();

        // Sincronizar roles solo si vienen en el request
        if ($request->filled('role')) {
            $user->syncRoles($request->role);
        }

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
 
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
