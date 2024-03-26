<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Module;
use Illuminate\Http\Request;

class AdminController extends Controller
{
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


    public function editModule(Request $request, $code)
    {

        $module = Module::where('code', $code)->firstOrFail();
        return view('content.pages.pages-module-edit', compact('module'));
    }
    public function updateModule(Request $request, $code)
    {

        $module = Module::where('code', $code)->firstOrFail();
        $module->update($request->only('name', 'description'));

        return redirect('/modules');
    }
    public function permission()
    {
        $modules = Module::all();
        return view('content.pages.pages-permission-add', compact('modules'));
    }
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
        return redirect('/permissions');
    }
   
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
    public function deletePermission($id)
    {
        $permissions = Permission::findOrFail($id);
        $permissions->delete();
        return redirect()->back()->with('message', 'course deleted successfully');
    }
    public function editPermission($id)
    {
        $modules = Module::all();
        $permission = Permission::where('id', $id)->firstOrFail();
        return view('content.pages.pages-permission-edit', compact('permission', 'modules'));
    }
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
        return redirect('/permissions');
    }
}