<?php

namespace App\Http\Controllers;

//use App\Models\Role;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    private function groupPermissions()
{
    // Agrupar permisos por la primera parte del nombre (antes del punto)
    $permissions = Permission::all()
        ->groupBy(function ($perm) {
            return explode(' ', $perm->name)[1] ?? 'otros';
        });

    return $permissions;
}

    public function index()
    {
        $roles = Role::withCount('permissions')->paginate(10);

        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = $this->groupPermissions();

        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:roles,name',
            'description' => 'nullable|string|max:255',
            'permissions' => 'array',
        ]);
        
        DB::transaction(function () use ($request) {
            $role = Role::create([
                'name' => $request->name,
                'description' => $request->description,
                'guard_name' => 'web',
            ]);

            if ($request->filled('permissions')) {
                $role->givePermissionTo($request->permissions);
            }
        });

        return redirect()->route('roles.index')
            ->with('success', 'Rol creado exitosamente.');
    }

    public function show(Role $role)
    {
        $role->load('permissions');
        $permissions = $this->groupPermissions();

        return view('roles.show', compact('role', 'permissions'));
    }

    public function edit(Role $role)
    {
        $permissions = $this->groupPermissions();
        
        return view('roles.permissions', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
{
    $request->validate([
        'name' => 'required|string|max:50|unique:roles,name,' . $role->id,
        'description' => 'nullable|string|max:255',
    ]);

    $role->update([
        'name' => $request->name,
        'description' => $request->description,
    ]);

    $role->syncPermissions($request->input('permissions', []));

    return redirect()->route('roles.index')
        ->with('success', 'Rol y permisos actualizados correctamente.');
}

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Rol eliminado correctamente.');
    }
}
