<?php

namespace App\Http\Controllers;

use App\DataTables\TeachersDataTable;
use App\Models\Teachers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeachersController extends Controller
{
    //
    public function getTeachers(TeachersDataTable $teachers)
    {
        $this->authorize('viewAny', User::class);

        return ($teachers->render('admin.teachers.teachers-index'));
    }
    
    public function edit($id)
    {
        $this->authorize('view', User::class);

        $teacher = Teachers::find($id);


        if ($teacher) {
            return view('admin.teachers.teacher-edit', ['teacher' => $teacher]);
        } else
            return redirect(route('admin.teachers'))->withErrors(trans('app.teachers.not-found'));
    }

    public function update(Request $request)
    {
        $data = ($request->all());
        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'degree' => ['required', 'string', 'max:255'],
        ], [], [])->validate();

        $teacher = Teachers::find($request->id);

        $this->authorize('update', new User);

        if ($teacher) {
            $teacher->setAttribute('name', $data['name']);
            $teacher->setAttribute('degree', $data['degree']);

            $teacher->save();

            return back()->with('success', trans('app.teachers.account-updated-successfully'));
        }
        return back()->withErrors(trans('app.teachers.not-found'));
    }

    public function newTeacher()
    {

        return view('admin.teachers.teacher-create');
    }

    public function create(Request $request)
    {
        $data = ($request->all());
        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'degree' => ['required', 'string', 'max:255'],
        ], [], [])->validate();

        $res = Teachers::create([
            'name' => $data['name'],
            'degree' => $data['degree'],
        ]);

        return back()->with('success', trans('app.teachers.record-added-successfully'));
    }

}
