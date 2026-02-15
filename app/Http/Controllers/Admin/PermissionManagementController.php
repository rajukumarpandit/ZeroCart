<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PermissionManagementController extends Controller
{
    /**
     * Display a listing of permissions
     */
    public function index(Request $request)
    {
        $query = Permission::withCount('roles');

        // Filter by module
        if ($request->filled('module')) {
            $query->where('name', 'like', $request->module . '.%');
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $permissions = $query->orderBy('name')->get();

        // Group permissions by module
        $permissionsByModule = $permissions->groupBy(function($permission) {
            return explode('.', $permission->name)[0] ?? 'general';
        });

        // Get all unique modules
        $modules = Permission::all()->map(function($permission) {
            return explode('.', $permission->name)[0] ?? 'general';
        })->unique()->sort()->values();

        // Statistics
        $totalPermissions = Permission::count();
        $activePermissions = Permission::count(); // You can add 'is_active' field if needed
        $totalModules = $modules->count();
        $totalRoles = Role::count();

        return view('Backend.permissions.index', compact(
            'permissionsByModule',
            'modules',
            'totalPermissions',
            'activePermissions',
            'totalModules',
            'totalRoles',
            'permissions'
        ));
    }

    /**
     * Show the form for creating a new permission
     */
    public function create()
    {
        // Get existing modules
        $modules = Permission::all()->map(function($permission) {
            return explode('.', $permission->name)[0] ?? 'general';
        })->unique()->sort()->values();

        return view('Backend.permissions.create', compact('modules'));
    }

    /**
     * Store a newly created permission
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
            'display_name' => 'nullable|string|max:255',
            'module' => 'required|string|max:100'
        ]);

        try {
            // Auto-format name as module.action
            $name = $request->name;
            if (!str_contains($name, '.')) {
                $name = strtolower($request->module) . '.' . strtolower($name);
            }

            Permission::create([
                'name' => $name,
                'display_name' => $request->display_name,
                'module' => strtolower($request->module),
                'guard_name' => 'web'
            ]);

            return redirect()
                ->route('admin.permissions.index')
                ->with('success', 'Permission created successfully.');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Failed to create permission: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified permission (AJAX)
     */
    public function show(Permission $permission)
    {
        $permission->load('roles');

        return response()->json([
            'id' => $permission->id,
            'name' => $permission->name,
            'display_name' => $permission->display_name,
            'description' => $permission->description,
            'module' => explode('.', $permission->name)[0] ?? 'general',
            'created_at' => $permission->created_at,
            'updated_at' => $permission->updated_at,
            'roles' => $permission->roles
        ]);
    }

    /**
     * Show the form for editing the specified permission
     */
    public function edit(Permission $permission)
    {
        // Get existing modules
        $modules = Permission::all()->map(function($p) {
            return explode('.', $p->name)[0] ?? 'general';
        })->unique()->sort()->values();

        $currentModule = explode('.', $permission->name)[0] ?? 'general';

        return view('Backend.permissions.edit', compact('permission', 'modules', 'currentModule'));
    }

    /**
     * Update the specified permission
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('permissions', 'name')->ignore($permission->id)
            ],
            'display_name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'module' => 'required|string|max:100'
        ]);

        try {
            // Auto-format name as module.action
            $name = $request->name;
            if (!str_contains($name, '.')) {
                $name = strtolower($request->module) . '.' . strtolower($name);
            }

            $permission->update([
                'name' => $name,
                'display_name' => $request->display_name,
                'description' => $request->description,
                'module' => strtolower($request->module)
            ]);

            return redirect()
                ->route('admin.permissions.index')
                ->with('success', 'Permission updated successfully.');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Failed to update permission: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified permission
     */
    public function destroy(Permission $permission)
    {
        try {
            // Check if permission is assigned to any roles
            $rolesCount = $permission->roles()->count();
            
            if ($rolesCount > 0) {
                return back()->with('error', "Cannot delete permission. It is assigned to {$rolesCount} role(s).");
            }

            $permission->delete();

            return redirect()
                ->route('admin.permissions.index')
                ->with('success', 'Permission deleted successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete permission: ' . $e->getMessage());
        }
    }

    /**
     * Sync permissions from code/config
     */
    public function sync(Request $request)
    {
        try {
            DB::beginTransaction();

            // Define your permissions structure
            $permissionsStructure = $this->getPermissionsStructure();

            $added = 0;
            $updated = 0;

            foreach ($permissionsStructure as $module => $actions) {
                foreach ($actions as $action => $details) {
                    $permissionName = strtolower($module) . '.' . strtolower($action);
                    
                    $permission = Permission::firstOrCreate(
                        ['name' => $permissionName],
                        [
                            'display_name' => $details['display_name'] ?? ucfirst($action) . ' ' . ucfirst($module),
                            'description' => $details['description'] ?? null,
                            'module' => strtolower($module),
                            'guard_name' => 'web'
                        ]
                    );

                    if ($permission->wasRecentlyCreated) {
                        $added++;
                    } else {
                        // Update display name and description if provided
                        $permission->update([
                            'display_name' => $details['display_name'] ?? $permission->display_name,
                            'description' => $details['description'] ?? $permission->description,
                            'module' => strtolower($module)
                        ]);
                        $updated++;
                    }
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Permissions synced successfully.',
                'added' => $added,
                'updated' => $updated
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to sync permissions: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get permissions structure for syncing
     * Customize this based on your application needs
     */
    private function getPermissionsStructure()
    {
        return [
            'users' => [
                'view' => ['display_name' => 'View Users', 'description' => 'Can view user list'],
                'create' => ['display_name' => 'Create Users', 'description' => 'Can create new users'],
                'edit' => ['display_name' => 'Edit Users', 'description' => 'Can edit user details'],
                'delete' => ['display_name' => 'Delete Users', 'description' => 'Can delete users'],
            ],
            'roles' => [
                'view' => ['display_name' => 'View Roles', 'description' => 'Can view role list'],
                'create' => ['display_name' => 'Create Roles', 'description' => 'Can create new roles'],
                'edit' => ['display_name' => 'Edit Roles', 'description' => 'Can edit role details'],
                'delete' => ['display_name' => 'Delete Roles', 'description' => 'Can delete roles'],
            ],
            'permissions' => [
                'view' => ['display_name' => 'View Permissions', 'description' => 'Can view permission list'],
                'create' => ['display_name' => 'Create Permissions', 'description' => 'Can create new permissions'],
                'edit' => ['display_name' => 'Edit Permissions', 'description' => 'Can edit permission details'],
                'delete' => ['display_name' => 'Delete Permissions', 'description' => 'Can delete permissions'],
            ],
            'products' => [
                'view' => ['display_name' => 'View Products', 'description' => 'Can view product list'],
                'create' => ['display_name' => 'Create Products', 'description' => 'Can create new products'],
                'edit' => ['display_name' => 'Edit Products', 'description' => 'Can edit product details'],
                'delete' => ['display_name' => 'Delete Products', 'description' => 'Can delete products'],
            ],
            'orders' => [
                'view' => ['display_name' => 'View Orders', 'description' => 'Can view order list'],
                'create' => ['display_name' => 'Create Orders', 'description' => 'Can create new orders'],
                'edit' => ['display_name' => 'Edit Orders', 'description' => 'Can edit order details'],
                'delete' => ['display_name' => 'Delete Orders', 'description' => 'Can delete orders'],
            ],
            'categories' => [
                'view' => ['display_name' => 'View Categories', 'description' => 'Can view category list'],
                'create' => ['display_name' => 'Create Categories', 'description' => 'Can create new categories'],
                'edit' => ['display_name' => 'Edit Categories', 'description' => 'Can edit category details'],
                'delete' => ['display_name' => 'Delete Categories', 'description' => 'Can delete categories'],
            ],
            'settings' => [
                'view' => ['display_name' => 'View Settings', 'description' => 'Can view system settings'],
                'edit' => ['display_name' => 'Edit Settings', 'description' => 'Can modify system settings'],
            ],
            'reports' => [
                'view' => ['display_name' => 'View Reports', 'description' => 'Can view reports'],
                'export' => ['display_name' => 'Export Reports', 'description' => 'Can export reports'],
            ],
        ];
    }

    /**
     * Bulk delete permissions
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'permission_ids' => 'required|array',
            'permission_ids.*' => 'exists:permissions,id'
        ]);

        try {
            $count = Permission::whereIn('id', $request->permission_ids)
                ->whereDoesntHave('roles')
                ->delete();

            return back()->with('success', "{$count} permission(s) deleted successfully.");

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete permissions: ' . $e->getMessage());
        }
    }
}