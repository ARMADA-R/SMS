<?php

namespace App\Http\Controllers;

use App\DataTables\StudentsDataTable;
use App\Models\Students;
use App\Models\StudentsAccPreActivation;
use App\Models\StudyLevels;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

use function PHPUnit\Framework\isEmpty;

class StudentsController extends Controller
{
    //
    public function getStudents(StudentsDataTable $students)
    {
        $this->authorize('viewAny', User::class);

        return ($students->render('admin.students.students-index'));
    }

    public function edit($id)
    {
        $this->authorize('view', User::class);

        $student = Students::find($id);
        $levels = StudyLevels::all();

        if ($student) {
            return view('admin.students.student-edit', ['student' => $student, 'levels' => $levels]);
        } else
            return redirect(route('admin.students'))->withErrors(trans('app.students.not-found'));
    }

    public function update(Request $request)
    {
        $data = ($request->all());
        Validator::make($data, [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'father_name' => ['required', 'string', 'max:255'],
            'mother_name' => ['required', 'string', 'max:255'],
            'level' => ['required', 'string', 'exists:study_levels,id'],
        ], [], [])->validate();

        $student = Students::find($request->id);

        $this->authorize('update', new User);

        if ($student) {
            $student->setAttribute('first_name', $data['fname']);
            $student->setAttribute('last_name', $data['lname']);
            $student->setAttribute('father_name', $data['father_name']);
            $student->setAttribute('mother_name', $data['mother_name']);
            $student->setAttribute('level_id', $data['level']);

            $student->save();

            return back()->with('success', trans('app.users.account-updated-successfully'));
        }
        return back()->withErrors(trans('app.users.not-found'));
    }

    public function newStudent()
    {
        $levels = StudyLevels::select(['id', 'name', 'code'])->get();

        return view('admin.students.student-create', ['levels' => $levels]);
    }

    public function create(Request $request)
    {
        $data = ($request->all());
        Validator::make($data, [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'father_name' => ['required', 'string', 'max:255'],
            'mother_name' => ['required', 'string', 'max:255'],
            'level' => ['required', 'string', 'exists:study_levels,id'],
        ], [], [])->validate();
        // dd($data);

        $res = Students::create([
            'first_name' => $data['fname'],
            'last_name' => $data['lname'],
            'father_name' => $data['father_name'],
            'mother_name' => $data['mother_name'],
            'level_id' => $data['level'],
        ]);

        StudentsAccPreActivation::create([
            'student_id' => $res->id,
            'username' => Carbon::now()->format('dhmsu').Str::random(10),
            'password' => Str::random(8),
        ]);

        return back()->with('success', trans('app.students.records-added-successfully', ['num' => 1 ]));
    }

    public function createExcel(Request $request)
    {
        // dd(json_decode($request->table, true));
        $data = ($request->all());
        $data['students'] = json_decode($request->table, true);

        Validator::make($data, [
            'level' => ['required', 'string', 'exists:levels,id', 'max:255'],
            'table' => ['required', 'string'],
            'students' => [
                'required',
                function ($attribute, $studentsData, $fail) {
                    $status = false;
                    $fail_msg = [];
                    foreach ($studentsData as $key => $value) {
                        $attr = [];
                        if (!isset($value['fname']) || $value['fname'] == '') {
                            $attr[] = trans('app.students.fname');
                        }
                        if (!isset($value['lname']) || $value['lname'] == '') {
                            $attr[] = trans('app.students.lname');
                        }
                        if (!isset($value['father_name']) || $value['father_name'] == '') {
                            $attr[] = trans('app.students.father-name');
                        }
                        if (!isset($value['mother_name']) || $value['mother_name'] == '') {
                            $attr[] = trans('app.students.mother-name');
                        }

                        if (!empty($attr)) {
                            $attr_msg = '';
                            foreach ($attr as $val) {
                                $attr_msg .= $val . ', ';
                            }
                            $status = true;
                            $fail_msg[] = 'The attributes ' . $attr_msg . 'in row number ' . ($key + 1) . ' is required.';
                        }
                    }
                    if ($status) {
                        $fail($fail_msg);
                    }
                }
            ],

        ], [], [])->validate();

        try {
            $records_num = 0;

            foreach ($data['students'] as $value) {
                $res = Students::create([
                    'first_name' => $value['fname'],
                    'last_name' => $value['lname'],
                    'father_name' => $value['father_name'],
                    'mother_name' => $value['mother_name'],
                    'level_id' => $data['level']
                ]);

                StudentsAccPreActivation::create([
                    'student_id' => $res->id,
                    'username' => Carbon::now()->format('dhmsu').Str::random(10),
                    'password' => Str::random(8),
                ]);

                $records_num++;
            }

            return back()->with('success', trans('app.students.records-added-successfully', ['num' => $records_num]));
        } catch (\Throwable $th) {

            return back()->withErrors(trans('app.students.errors.insert-students-error'));
            // throw $th;
        }

        dd(json_decode($request->table, true), 'finsh');
    }
}
