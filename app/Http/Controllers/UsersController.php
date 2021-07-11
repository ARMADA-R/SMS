<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{

    public function getUsers(UsersDataTable $user)
    {
        $this->authorize('viewAny', User::class);

        return ($user->render('admin.users.users-index'));
    }

    public function accountDetails($id)
    {
        $this->authorize('view', User::class);
        $user = DB::table('users')->select([
            'users.*',
            'roles.name as role'
        ])
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->where('users.id', $id)
            ->get();

        if ($user->first() != null) {
            return view('admin.users.user-details', ['user' => $user->first()]);
        } else {
            return redirect(route('admin.Users'))->withErrors(trans('app.users.not-found'));
        }
    }

    public function editAccountGET($id)
    {
        $this->authorize('view', User::class);

        $user = User::find($id);
        $roles = Roles::all();

        if ($user) {
            return view('admin.users.user-edit', ['user' => $user, 'roles' => $roles]);
        } else
            return redirect(route('admin.Users'))->withErrors(trans('app.users.not-found'));
    }

    public function editAccountPOST(Request $request)
    {

        $data = ($request->all());
        Validator::make($data, [
            'role' => ['required'],
            'name' => ['required', 'string', 'max:255'],
        ], [], [])->validate();
        $user = User::find($request->id);

        $this->authorize('update', $user);

        if ($user) {
            $user->setAttribute('name', $data['name']);
            $user->setAttribute('role_id', $data['role']);

            $user->save();

            return back()->with('success', trans('app.users.account-updated-successfully'));
        }
        return back()->withErrors(trans('app.users.not-found'));
    }


    public function UpdateAcountPassword(Request $request)
    {
        // $this->authorize('update', User::class);

        $data = ($request->all());
        Validator::make($data, [
            'id' => ['required'],
            'password' => ['required', 'confirmed'],
        ], [], [])->validate();

        $user = User::find($request->id);

        $this->authorize('update', $user);

        if ($user) {
            $user->setAttribute('password', Hash::make($data['password']));
            $user->save();

            return back()->with('success', trans('app.users.account-updated-successfully'));
        }
        return back()->withErrors('app.users.not-found');
    }



    public function closeAccount(Request $request)
    {
        $data = ($request->all());
        Validator::make($data, [
            'id' => ['required'],
        ], [], [])->validate();

        $user = User::find($request->id);

        $this->authorize('update', $user);

        if ($user) {
            DB::table('users')
                ->where('id', $request->id)
                ->update([
                    'settings->status' => 'closed',
                ]);

            // event(new CloseAccount($user));

            return back()->with('success', trans('app.users.account-updated-successfully'));
        }
        return back()->withErrors('app.users.not-found');
    }

    public function activateAccount(Request $request)
    {
        $data = ($request->all());
        Validator::make($data, [
            'id' => ['required'],
        ], [], [])->validate();

        $user = User::find($request->id);

        $this->authorize('update', $user);


        if ($user) {

            DB::table('users')
                ->where('id', $request->id)
                ->update([
                    'settings->status' => 'active',
                ]);

            // event(new ActivateAccount($user));

            return back()->with('success', trans('app.users.account-updated-successfully'));
        }
        return back()->withErrors('app.users.not-found');
    }

    public function ShowClosedAccountView(Request $request)
    {
        if (Auth::guard('admin')->user()->status == 'closed') {
            return view('admin.auth.closedAccount');
        }
        return redirect(route('admin.home'));
    }

    public function createGet()
    {
        $roles = Roles::all();

        return view('admin.users.user-create', ['roles' => $roles]);
    }

    public function create(Request $request)
    {
        $data = ($request->all());
        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [], [])->validate();

        $res = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'role_id' => $data['role'],
            'role_id' => $data['role'],
            'password' => Hash::make($data['password']),
            'settings' => json_encode(['status' => 'active']),
        ]);

        return back()->with('success', trans('app.users.account-created-successfully'));
    }
}
