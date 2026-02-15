<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RoleManagementController extends Controller
{
    /**
     * Display a listing of roles
     */
    public function index()
    {
        $roles = Role::withCount(['permissions', 'users'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            
        return view('Backend.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role
     */
    public function create()
    {
        // Get all permissions grouped by module
        $permissions = Permission::all();
        $permissionsByModule = $permissions->groupBy(function($permission) {
            // Extract module from permission name (e.g., 'users.create' -> 'users')
            return explode('.', $permission->name)[0] ?? 'general';
        });

        return view('Backend.roles.create', compact('permissionsByModule'));
    }

    /**
     * Store a newly created role
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
            'guard_name' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();

            // Create the role
            $role = Role::create([
                'name' => $request->name,
                'guard_name' => $request->guard_name ?? 'web'
            ]);

            // Sync permissions
            if ($request->permissions) {
                $role->syncPermissions($request->permissions);
            }
            auditLog('Created New Role permission ('.$role->name.')', auth()->user(), ['role' => $role->name]);
            DB::commit();

            return redirect()
                ->route('admin.roles.index')
                ->with('success', 'Role created successfully with ' . count($request->permissions ?? []) . ' permissions.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Failed to create role: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified role
     */
    public function show(Role $role)
    {
        $role->load(['permissions', 'users']);
        
        // Get recent users with this role (limit to 10)
        $recentUsers = $role->users()
            ->latest()
            ->limit(10)
            ->get();

        return view('Backend.roles.show', compact('role', 'recentUsers'));
    }

    /**
     * Show the form for editing the specified role
     */
    public function edit(Role $role)
    {
        $role->load('permissions');
        
        // Get all permissions grouped by module
        $permissions = Permission::all();
        $permissionsByModule = $permissions->groupBy(function($permission) {
            return explode('.', $permission->name)[0] ?? 'general';
        });
        
        return view('Backend.roles.edit', compact('role', 'permissionsByModule'));
    }

    /**
     * Update the specified role
     */
    public function update(Request $request, Role $role)
    {
        // Prevent editing Super Admin role name
        $nameValidation = $role->name === 'super_admin' 
            ? 'required|string|max:255' 
            : 'required|string|max:255|unique:roles,name,' . $role->id;

        $request->validate([
            'name' => $nameValidation,
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
            'guard_name' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();

            // Don't allow changing Super Admin role
            if ($role->name === 'super_admin' && $request->name !== 'super_admin') {
                return back()->with('error', 'Cannot modify Super Admin role name.');
            }

            // Update the role (except for Super Admin)
            if ($role->name !== 'super_admin') {
                $role->update([
                    'name' => $request->name,
                    'guard_name' => $request->guard_name ?? 'web'
                ]);

                // Sync permissions
                $role->syncPermissions($request->permissions ?? []);
            } 
            auditLog('Updated Role permission ('.$role->name.')', auth()->user(), ['role' => $role->name]);
            DB::commit();

            return redirect()
                ->route('admin.roles.index')
                ->with('success', 'Role updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Failed to update role: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified role
     */
    public function destroy(Role $role)
    {
        // Prevent deleting Super Admin or default roles
        if ($role->name === 'super_admin') {
            return back()->with('error', 'Cannot delete Super Admin role.');
        }


        try {
            // Check if role has users
            $usersCount = $role->users()->count();
            
            if ($usersCount > 0) {
                return back()->with('error', "Cannot delete role. It is assigned to {$usersCount} user(s).");
            }

            $role->delete();
            auditLog('Deleted Role permission ('.$role->name.')', auth()->user(), ['role' => $role->name]);
            return redirect()
                ->route('admin.roles.index')
                ->with('success', 'Role deleted successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete role: ' . $e->getMessage());
        }
    }

    /**
     * Duplicate a role (AJAX)
     */
    public function duplicate(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name'
        ]);

        try {
            DB::beginTransaction();

            $newRole = Role::create([
                'name' => $request->name,
                'guard_name' => 'web'
            ]);

            // Copy all permissions
            $newRole->syncPermissions($role->permissions);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Role duplicated successfully.',
                'role' => $newRole
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to duplicate role: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Export role data (JSON)
     */
    public function export(Role $role)
    {
        $role->load('permissions');

        $data = [
            'name' => $role->name,
            'permissions' => $role->permissions->pluck('name')->toArray(),
            'exported_at' => now()->toIso8601String()
        ];

        $fileName = Str::slug($role->name) . '-role-export-' . now()->format('Y-m-d') . '.json';
        auditLog('Role and permission export in json format', auth()->user(), ['role' => $role->name]);
        return response()->json($data)
            ->header('Content-Type', 'application/json')
            ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }

    /**
     * Assign role to multiple users
     */
    public function assignToUsers(Request $request, Role $role)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id'
        ]);

        try {
            $users = \App\Models\User::whereIn('id', $request->user_ids)->get();
            
            foreach ($users as $user) {
                $user->assignRole($role);
            }
            
            return back()->with('success', "Role assigned to {$users->count()} user(s) successfully.");

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to assign role: ' . $e->getMessage());
        }
    }
}