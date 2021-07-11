<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\GroupStudentsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Students;
use App\Models\Study_group;
use App\Models\Study_group_student;
use App\Models\Teachers;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class CourseGroupsController extends Controller
{
    
    public function newGroup($id)
    {
        $this->authorize('create', Course::class);

        $course = Course::find($id);

        if ($course) {
            $seasons = DB::table('seasons')->orderBy('created_at', 'desc')->get();

            $teachers = Teachers::all();
            return view('admin.courses.groups.group-create', ['seasons' => $seasons, 'course' => $course, 'teachers' => $teachers]);
        } else {
            return back()->withErrors(trans('app.courses.group.not-found'));
        }
    }

    public function create(Request $request)
    {
        $this->authorize('create', Course::class);

        $data = ($request->all());

        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'course_id' => ['required', 'string', 'exists:courses,id', 'max:255'],
            'teacher' => ['required', 'string', 'exists:teachers,id', 'max:255'],
            'season' => ['required', 'string', 'exists:seasons,id', 'max:255'],
            'day' => ['required', 'string', Rule::in(['sat', 'sun', 'mon', 'tue', 'wed', 'thu', 'fri']), 'max:3'],
            'start' => ['required', 'date_format:H:i'],
            'end' => ['required', 'date_format:H:i'],
        ], [], [])->validate();


        $group =  Study_group::create([
            'course_id' => $data['course_id'],
            'name' => $data['name'],
            'teacher_id' => $data['teacher'],
            'season_id' => $data['season'],
            'start' => $data['start'],
            'end' => $data['end'],
            'day' => $data['day'],
        ]);

        return redirect(route('admin.courses.details', $data['course_id']))->with('success', trans('app.courses.created-successfully'));
    }




    public function edit($id)
    {
        $this->authorize('view', Course::class);

        $study_group = Study_group::select(['study_groups.*', 'courses.name as course_name', 'courses.code as course_code'])
            ->join('courses', 'courses.id', '=', 'study_groups.course_id')
            ->where('study_groups.id', $id)->get()->first();

        if ($study_group) {

            $seasons = DB::table('seasons')->orderBy('created_at', 'desc')->get();

            $teachers = Teachers::all();
            return view('admin.courses.groups.group-edit', ['seasons' => $seasons, 'study_group' => $study_group, 'teachers' => $teachers]);
        } else {
            return back()->withErrors(trans('app.courses.group.not-found'));
        }
    }



    public function update(Request $request)
    {
        $this->authorize('update', Course::class);

        $data = ($request->all());

        Validator::make($data, [
            'study_group_id' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'teacher' => ['required', 'string', 'exists:teachers,id', 'max:255'],
            'season' => ['required', 'string', 'exists:seasons,id', 'max:255'],
            'day' => ['required', 'string', Rule::in(['sat', 'sun', 'mon', 'tue', 'wed', 'thu', 'fri']), 'max:3'],
            'start' => ['required', 'date_format:H:i'],
            'end' => ['required', 'date_format:H:i'],
        ], [], [])->validate();

        $study_group = Study_group::find($request->study_group_id);

        if ($study_group) {

            $study_group->name = $data['name'];
            $study_group->teacher_id = $data['teacher'];
            $study_group->season_id = $data['season'];
            $study_group->day = $data['day'];
            $study_group->start = $data['start'];
            $study_group->end = $data['end'];

            $study_group->save();

            return back()->with('success', trans('app.courses.group.updated-successfully'));
        } else {
            return back()->withErrors(trans('app.courses.group.not-found'));
        }
    }




    public function delete(Request $request)
    {
        $this->authorize('delete', Course::class);

        $data = ($request->all());

        Validator::make($data, [
            'id' => ['required'],
        ], [], [])->validate();
        if (Study_group::find($request->id)->delete()) {
            return back()->with('success', trans('app.courses.group.deleted-successfully'));
        } else {
            return back()->withErrors(trans('app.something-went-wrong'));
        }
    }

    public function details($id)
    {
        $this->authorize('view', Course::class);

        $group = DB::table('study_groups')
            ->join('courses', 'study_groups.course_id', '=', 'courses.id')
            ->join('seasons', 'seasons.id', '=', 'study_groups.season_id')
            ->join('teachers', 'teachers.id', '=', 'study_groups.teacher_id')
            ->select(
                'study_groups.id',
                'study_groups.name',
                'study_groups.start',
                'study_groups.end',
                'study_groups.day',
                'study_groups.created_at',
                'study_groups.updated_at',
                'seasons.name AS season',
                'teachers.name AS teacher'
            )
            ->where('study_groups.id', $id)
            ->get();
        if ($group->first()) {
            return view('admin.courses.groups.group-details', ['group' => $group->first()]);
        } else {
            return back()->withErrors(trans('app.courses.group.not-found'));
        }
    }

    public function getGroupStudents($id)
    {
        $this->authorize('viewAny', Course::class);

        $query = Study_group_student::select([
            'study_group_students.id AS SGS_id',
            'students.id',
            'students.first_name',
            'students.last_name',
            'students.father_name',
            'study_levels.name AS level',
        ])->join('students', 'students.id', '=', 'Study_group_students.student')
            ->join('study_levels', 'study_levels.id', '=', 'students.level_id')
            ->where('Study_group_students.study_group_id', $id);

        return DataTables::of($query)
            ->addColumn('action',  function ($groupStudent) use ($id) {
                return '<div class="row justify-content-center">
            <div class="col my-1">
                <a type="button" class="btn btn-sm btn-warning " title="' . trans('app.view') . '" style="margin: 0px;" id="view_$groupStudent->id" href="' . route('admin.course.group.student.details', [$id, $groupStudent->id]) . '">
                    <i class="far fa-eye"></i>
                </a>
            </div>
        
            <div class="col my-1">
                <a type="button" class="btn btn-sm btn-info " title="' . trans('app.edit') . '" style="margin: 0px;" id="edit_$groupStudent->id" href="' . route('admin.course.group.student.edit', [$id, $groupStudent->id]) . '">
                    <i class="far fa-edit"></i>
                </a>
            </div>
        
            <div class="col my-1">
                <a type="button" class="btn btn-sm btn-danger " title="' . trans('app.delete') . '" style="margin: 0px;" data-toggle="modal" onclick="
                                if (confirm(\'Are you sure you want to remove this student?\')) {
                                    document.getElementById(' . $groupStudent->SGS_id . ').submit();
                                }">
                    <i class="far fa-trash-alt"></i>
                </a>
            </div>
        
        </div>
        <form role="form" id="' . $groupStudent->SGS_id . '"action="' . route('admin.course.group.student.remove', $id) . '" method="POST">
            <input type="hidden" name="_token" value=" ' . csrf_token() . '">
            <input type="hidden" name="SGS_id" value="' . $groupStudent->SGS_id . '">
        </form>';
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function removeStudentFromGroup(Request $request, $id)
    {
        $this->authorize('delete', Course::class);

        $data = ($request->all());

        Validator::make($data, [
            'SGS_id' => ['required'],
        ], [], [])->validate();
        if (Study_group_student::find($request->SGS_id)->delete()) {
            return back()->with('success', trans('app.courses.group.student-removed-successfully'));
        } else {
            return back()->withErrors(trans('app.something-went-wrong'));
        }
    }

    public function addStudentToGroup($id)
    {
        $study_group = Study_group::find($id);

        if ($study_group) {
            return view('admin.courses.groups.group-add-students', ["group" => $id]);
        } else {
            return back()->withErrors(trans('app.courses.group.not-found'));
        }
    }

    public function addStudentToGroupData($id)
    {
        $students_in_group = json_decode(Study_group_student::select(['student'])->where('study_group_id', $id)->get(), true);
        foreach ($students_in_group as $key => $value) {
            $students_in_group[$key] = $value['student'];
        }

        $query = Students::select([
            'students.id',
            'students.first_name',
            'students.last_name',
            'students.father_name',
            'study_levels.name AS level',
        ])->join('study_levels', 'study_levels.id', '=', 'students.level_id')
            ->whereNotIn('students.id', $students_in_group);


        return DataTables::of($query)
            ->addColumn('action',  function ($student) {
                return '<div class="row justify-content-center">
                            <div class="col my-1">
                                <div>
                                    <input class="inp-cbx" onclick="updateStudentsNum(this)" type="checkbox" style="display: none;" name="students[]" value="' . $student->id . '" id="' . $student->id . '"/> 
                                    <label class="cbx " for="' . $student->id . '">
                                        <span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>';
            })
            ->addIndexColumn()
            ->make(true);
    }


    public function addStudentToGroupPOST(Request $request, $id)
    {
        $study_group = Study_group::find($id);
        $data = $request->all();
        if ($study_group) {
            Validator::make($data, [
                'students' => [
                    'required',
                    function ($attribute, $studentsIds, $fail) {
                        $status = false;
                        $condition = true;
                        $query = DB::table('students');
                        foreach ($studentsIds as $value) {
                            if ($condition) {
                                $query->where('id', $value);
                                $condition = false;
                            } else {
                                $query->orWhere('id', $value);
                            }
                        }
                        $studentsCount = $query->count();
                        if (count($studentsIds) != $studentsCount) {
                            $fail("you have " . count($studentsIds) - $studentsCount . " invalid student\s !!");
                        }
                    }
                ],

            ], [], [])->validate();

            $grades_schema = json_decode(DB::table('study_groups')->select('courses.grades_schema')
                ->join('courses', 'courses.id', '=', 'study_groups.course_id')
                ->where('study_groups.id', $id)->get()->first()->grades_schema, true);

            $grades = [];
            foreach ($grades_schema['grade_sections'] as $key => $value) {
                $grades[$key] = 0;
            }

            foreach ($data['students'] as $value) {
                Study_group_student::create([
                    'student' => $value,
                    'study_group_id' => $id,
                    'grades' => json_encode($grades)
                ]);
            }

            return redirect(route('admin.course.group.details', $id));
        } else {
            return back()->withErrors(trans('app.courses.group.not-found'));
        }
    }


    public function groupStudentDetails($group_id, $student_id)
    {
        $study_group = Study_group::find($group_id);
        if ($study_group) {

            $student = Students::find($student_id);

            if ($student) {
                $group = DB::table('study_groups')
                    ->join('courses', 'study_groups.course_id', '=', 'courses.id')
                    ->join('seasons', 'seasons.id', '=', 'study_groups.season_id')
                    ->join('teachers', 'teachers.id', '=', 'study_groups.teacher_id')
                    ->select(
                        'study_groups.id',
                        'study_groups.name',
                        'study_groups.start',
                        'study_groups.end',
                        'study_groups.day',
                        'study_groups.created_at',
                        'study_groups.updated_at',
                        'seasons.name AS season',
                        'teachers.name AS teacher'
                    )
                    ->where('study_groups.id', $group_id)
                    ->get();

                $student_grades = Study_group_student::where('study_group_id', $group_id)
                    ->where('student', $student_id)->get()->first();

                return view('admin.courses.groups.students.student-group-details', ['group' => $group->first(), 'student' => $student, 'student_grades' => $student_grades]);
            } else
                return back()->withErrors(trans('app.courses.group.student-not-found'));
        } else
            return back()->withErrors(trans('app.courses.group.not-found'));
    }


    public function groupStudentEdit($group_id, $student_id)
    {
        $study_group = Study_group::find($group_id);
        if ($study_group) {

            $student = Students::find($student_id);

            if ($student) {
                $group = DB::table('study_groups')
                    ->join('courses', 'study_groups.course_id', '=', 'courses.id')
                    ->join('seasons', 'seasons.id', '=', 'study_groups.season_id')
                    ->join('teachers', 'teachers.id', '=', 'study_groups.teacher_id')
                    ->select(
                        'study_groups.id',
                        'study_groups.name',
                        'study_groups.start',
                        'study_groups.end',
                        'study_groups.day',
                        'study_groups.created_at',
                        'study_groups.updated_at',
                        'courses.grades_schema',
                        'seasons.name AS season',
                        'teachers.name AS teacher'
                    )
                    ->where('study_groups.id', $group_id)
                    ->get();

                $student_grades = Study_group_student::where('study_group_id', $group_id)
                    ->where('student', $student_id)->get()->first();

                return view('admin.courses.groups.students.student-group-edit', ['group' => $group->first(), 'student' => $student, 'student_grades' => $student_grades]);
            } else
                return back()->withErrors(trans('app.courses.group.student-not-found'));
        } else
            return back()->withErrors(trans('app.courses.group.not-found'));
    }

    public function groupStudentUpdate($group_id, $student_id, Request $request)
    {
        $study_group = Study_group::find($group_id);
        if ($study_group) {
            $student = Students::find($student_id);
            if ($student) {

                $data = ($request->all());

                $study_group_student = Study_group_student::where('study_group_id', $group_id)
                    ->where('student', $student_id)->get()->first();

                //get the the group course to take grades schema
                $course_grades_schema = Course::find($study_group->course_id)->Grades_schema;

                //convert grades schema from text to json and take the schema of sections
                $grades_schema = (json_decode($course_grades_schema, true)['grade_sections']);

                // get the last stored students grades
                $student_grades = json_decode($study_group_student->grades, true);

                $validate_rows = [];

                // define validation rows dynamicly based on students last grades and pre define course grades schema
                foreach ($student_grades as $key => $value) {
                    $validate_rows[$key] = ['required', 'max:' . $grades_schema[$key], 'min:0'];
                }

                Validator::make($data, $validate_rows, [], [])->validate();

                unset($data['_token']);

                
                
                $study_group_student->grades = json_encode($data);
                $study_group_student->save();
                // dd($study_group_student, $course_grades_schema, $student_grades, $validate_rows, $data, json_encode($data));

                return back()->with('success', trans('app.courses.group.student-data-updated-successfully'));

            } else
                return back()->withErrors(trans('app.courses.group.student-not-found'));
        } else
            return back()->withErrors(trans('app.courses.group.not-found'));
    }
}
