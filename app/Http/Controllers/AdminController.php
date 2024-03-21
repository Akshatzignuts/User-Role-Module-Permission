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
        return view('content.pages.pages-permission-add');
    }
    public function addPermission(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $permissions = Permission::create($request->only('name', 'description'));

        return redirect('/permissions')->with('success', 'Permission added successfully');
    }
    /* public function displayPermission()
    {
        $permissions = Permission::all();
        return view('content.pages.pages-permission', compact('permissions'));
    }*/
}
