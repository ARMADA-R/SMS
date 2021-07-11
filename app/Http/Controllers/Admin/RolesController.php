<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RolesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Roles;
use App\Models\Role_Permission;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;

class RolesController extends Controller
{
    //
    protected $id;
    public function roles(RolesDataTable $roles)
    {
        $this->authorize('viewAny', Roles::class);

        return $roles->render('admin.roles.roles-index');
    }



    public function details($id)
    {
        $this->authorize('view', Roles::class);

        $role = Roles::find($id);

        if ($role != null) {

            $permissions = Permission::all();
            $permission_groups = DB::table('permissions')->distinct()->select(['group',])->get();
            $role_permissions = Role_Permission::select(['permission_id'])->distinct()->where('role_id', $role->id)->get()->toArray();

            foreach ($role_permissions as $key => $value) {
                $role_permissions[$key] = $value['permission_id'];
            }

            $permissions_by_groups = [];
            foreach ($permission_groups as  $group) {
                foreach ($permissions as  $permission) {
                    if ($permission->group == $group->group) {
                        $permissions_by_groups[$group->group][] = [
                            'name' => $permission->name,
                            'id' => $permission->id,
                            'checked' => in_array($permission->id, $role_permissions)
                        ];
                    }
                }
            }
            return view('admin.roles.role-details', ['role' => $role, 'permissions_by_groups' => $permissions_by_groups]);
        } else {
            return back()->withErrors(trans('app.role.not-found'));
        }
    }




    public function edit($id)
    {

        $this->authorize('view', Roles::class);

        $role = Roles::find($id);
        if ($role != null) {
            $permissions = Permission::all();
            $permission_groups = DB::table('permissions')->distinct()->select(['group',])->get();
            $role_permissions = Role_Permission::select(['permission_id'])->distinct()->where('role_id', $role->id)->get()->toArray();

            foreach ($role_permissions as $key => $value) {
                $role_permissions[$key] = $value['permission_id'];
            }

            $permissions_by_groups = [];
            foreach ($permission_groups as  $group) {
                foreach ($permissions as  $permission) {
                    if ($permission->group == $group->group) {
                        $permissions_by_groups[$group->group][] = [
                            'name' => $permission->name,
                            'id' => $permission->id,
                            'checked' => in_array($permission->id, $role_permissions)
                        ];
                    }
                }
            }

            return view('admin.roles.role-edit', ['role' => $role, 'permissions_by_groups' => $permissions_by_groups]);
        } else {
            return back()->withErrors(trans('app.role.not-found'));
        }
    }



    public function update(Request $request)
    {
        $this->authorize('update', Roles::class);


        $role = Roles::find($request->role_id);

        if ($role) {
            $permissions = Permission::whereIn('id', $request->permissions)->get()->toArray();

            foreach ($permissions as $key => $value) {
                $permissions[$key] = $value['id'];
            }

            Role_Permission::where('role_id', $role->id)->delete();

            foreach ($permissions as $key => $permission) {
                Role_Permission::create([
                    'role_id' => $role->id,
                    'permission_id' => $permission,
                ]);
            }
            return back()->with('success', trans('app.role.updated-successfuly'));
        } else {
            return back()->withErrors(trans('app.role.not-found'));
        }
    }



    public function newRole()
    {
        $this->authorize('create', Roles::class);

        $permissions = Permission::all();
        $permission_groups = $user = DB::table('permissions')->distinct()->select([
            'group',
        ])->get();

        // dd($permission_groups);

        $permissions_by_groups = [];
        foreach ($permission_groups as  $group) {
            foreach ($permissions as  $permission) {
                if ($permission->group == $group->group) {
                    $permissions_by_groups[$group->group][] = [
                        'name' => $permission->name,
                        'id' => $permission->id,
                    ];
                }
            }
        }
        return view('admin.roles.role-create', ['permissions_by_groups' => $permissions_by_groups]);
    }

    public function create(Request $request)
    {
        $this->authorize('create', Roles::class);

        $data = ($request->all());

        Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:roles'],
        ], [], [])->validate();

        $role =  Roles::create([
            'name' => $data['name']
        ]);

        if ($request->permissions) {
            foreach ($request->permissions as $permission) {
                Role_Permission::create([
                    'role_id' => $role->id,
                    'permission_id' => $permission,
                ]);
            }
        }
        return redirect(route('admin.showRoles'))->with('success', trans('app.role.created-successfuly'));
    }

    public function delete(Request $request)
    {
        $this->authorize('delete', Roles::class);

        $data = ($request->all());

        Validator::make($data, [
            'id' => ['required'],
        ], [], [])->validate();
        if (Roles::find($request->id)->delete()) {

            return back()->with('success', trans('app.role.deleted-successfuly'));
        } else {
            return back()->withErrors(trans('app.something-went-wrong'));
        }
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
