<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Module;
use App\Models\ModulePermission;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //this can be used redirect to home page 
    public function indexHomePage()
    {
        return view('content.pages.pages-home');
    }
    //this can be used display the module on module page  
    public function displayModule(Request $request)
    {
        $search = $request->query('search', '');
        $queries = Module::query()->whereNull('parent_module_code');
        if ($request->has('search')) {
            $search = $request->search;
            $queries->where('name', 'like', "%{$search}%");
        }
        if ($request->has('filter')) {
            $filter = $request->filter;
            if ($filter === 'active') {
                $queries->where('is_active', 1);
            } else if ($filter === 'deactive') {
                $queries->where('is_active', 0);
            }
        }
        $modules = $queries->with('subModules')->get();
        return view('content.pages.pages-module', compact('modules', 'search'));
    }
    //this can be used redirect the edit module page   
    public function editModule(Request $request, $code)
    {

        $module = Module::where('code', $code)->firstOrFail();
        return view('content.pages.pages-module-edit', compact('module'));
    }
    //this can be used update the module and submodule  
    public function updateModule(Request $request, $code)
    {

        $module = Module::where('code', $code)->firstOrFail();
        $module->update($request->only('name', 'description'));

        return redirect('/modules/')->with('success', 'Module updated successfully');
    }
    //this can be used redirect to permission page  
    public function permission()
    {
        $modules = Module::all();
        return view('content.pages.pages-permission-add', compact('modules'));
    }
    //this can be used for add permission 
    public function addPermission(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',

        ]);
        $permissions = Permission::create($request->only('name', 'description'));
        $modules = Module::all();
        foreach ($modules as $module) {
            $moduleCode = $module->code;
            $permissions->modules()->attach(
                $moduleCode,
                [
                    'add' => $request->has('addCheckbox' . $moduleCode),
                    'edit' => $request->has('editCheckbox' . $moduleCode),
                    'delete' => $request->has('deleteCheckbox' . $moduleCode),
                    'view' => $request->has('viewCheckbox' . $moduleCode)
                ]
            );
        }
        return redirect('/permissions/');
    }
    //this can be used for display permission on the permissin page
    public function displayPermission(Request $request)
    {
        $search = $request->input('search');
        $filter = $request->input('filter');
        $query = Permission::query();
        if ($request->has('search')) {
            $query->when($request->has('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where('name', 'like', "%{$search}%");
            });
        }
        if ($filter === 'activated') {
            $query->where('is_active', 1);
        } elseif ($filter === 'deactivated') {
            $query->where('is_active', 0);
        }
        $permissions = $query->get();
        return view('content.pages.pages-permission', compact('permissions', 'search', 'filter'));
    }
    //this can be used for delete the permission
    public function deletePermission($id)
    {
        $permissions = Permission::findOrFail($id);
        $permissions->delete();
        return redirect()->back()->with('message', 'course deleted successfully');
    }
    //this can be used for redirect edit permission page  
    public function editPermission($id)
    {
        $modules = Module::all();
        $permission = Permission::where('id', $id)->firstOrFail();
        return view('content.pages.pages-permission-edit', compact('permission', 'modules'));
    }
    //this can be used for update permission  
    public function updatePermission(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        // Find the permission record by ID
        $permission = Permission::findOrFail($id);

        // Update the permission record
        $permission->update($request->only('name', 'description'));

        // Detach all existing module permissions
        $permission->modules()->detach();

        // Attach new module permissions based on the checkboxes
        $modules = Module::all();
        foreach ($modules as $module) {
            $moduleCode = $module->code;
            $permission->modules()->attach(
                $moduleCode,
                [
                    'add' => $request->has('addCheckbox' . $moduleCode),
                    'edit' => $request->has('editCheckbox' . $moduleCode),
                    'delete' => $request->has('deleteCheckbox' . $moduleCode),
                    'view' => $request->has('viewCheckbox' . $moduleCode)
                ]
            );
        }
        return redirect('/permissions/');
    }
    //this can be used for toggle switch for permission is_active 

    public function toggleStatus(Request $request)
    {
        // Retrieve the Permission model based on the provided ID
        $permissionId = $request->input('permission_id');
        $permission = Permission::find($permissionId);
        if (!$permission) {
            return response()->json(['error' => 'Permission not found'], 404);
        }

        // Toggle the is_active status based on the request input
        $permission->is_active = !$permission->is_active;
        $permission->save();

        return response()->json(['message' => 'Permission status toggled successfully'], 200);
    }

    //this can be used for toggle switch for module is_active  
    public function toggleModuleStatus(Request $request)
    {
        $module_code = $request->input('module_code');
        $is_active = $request->input('is_active');

        $module = Module::where('code', $module_code)->first();
        if (!$module) {
            return response()->json(['error' => 'Module not found'], 404);
        }
        $module->is_active = $is_active;
        $module->save();

        return response()->json(['message' => 'Module status toggled successfully'], 200);
    }
    //this can be used for redirect to role page  
    public function roleIndex()
    {
        return view('content.pages.pages-role');
    }
    //this can be used for redirect to role form page  
    public function role()
    {
        $permissions = Permission::all();
        return view('content.pages.pages-role-add', compact('permissions'));
    }
    //this can be used for add role data to the database 
    public function addRole(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'permissions' => 'required|array'

        ]);
        $roles = Role::create($request->only('name', 'description'));
        if ($request->has('permissions')) {
            $roles->permissions()->attach($request->permissions);
        }
        return redirect('/role/')->with('success', 'Role created successfully.');
    }
    //this can be used for displaying the role page with role data  
    public function displayRole(Request $request)
    {
        $search = $request->input('search');
        $filter = $request->input('filter');
        $query = Role::query()->with('permissions');
        //dd($roles);
        if ($request->has('search')) {
            $query->when($request->has('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where('name', 'like', "%{$search}%");
            });
        }
        if ($filter === 'activated') {
            $query->where('is_active', 1);
        } elseif ($filter === 'deactivated') {
            $query->where('is_active', 0);
        }
        $roles = $query->get();

        return view('content.pages.pages-role', compact('roles', 'filter', 'search'));
    }
    //this can be used for toggle the is_active switch  
    public function toggleRoleStatus(Request $request)
    {
        // Retrieve the Role model based on the provided ID
        $roleId = $request->input('role_id');
        $role = Role::find($roleId);
        if (!$role) {
            return response()->json(['error' => 'Role not found'], 404);
        }
        // Toggle the is_active status based on the request input
        $role->is_active = !$role->is_active;
        $role->save();
        return response()->json(['message' => 'Role status toggled successfully'], 200);
    }
    //this can be used for redirect to edit role page  
    public function editRole($id)
    {
        $permissions = Permission::all();
        $roles = Role::where('id', $id)->firstOrFail();
        return view('content.pages.pages-role-edit', compact('permissions', 'roles'));
    }
    //this can be used for updating role 
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'permissions' => 'required|array'

        ]);
        $roles = Role::findOrFail($id);
        $roles->update($request->only('name', 'description'));
        if ($request->has('permissions')) {
            $roles->permissions()->sync($request->permissions);
        }
        return redirect('/role');
    }
    //this can be used for deleting role 
    public function deleteRole($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->back();
    }
}
