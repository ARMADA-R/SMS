<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CoursesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Notification;
use App\Models\StudyLevels;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
	

    public function courses(CoursesDataTable $courses)
    {
        $this->authorize('viewAny', Course::class);

        return $courses->render('admin.courses.courses-index');
    }


    public function details($id)
    {
        $this->authorize('view', Course::class);

        $course = Course::find($id);
        if ($course) {


            $groups = DB::table('study_groups')
                ->join('courses', 'study_groups.course_id', '=', 'courses.id')
                ->join('seasons', 'seasons.id', '=', 'study_groups.season_id')
                ->join('teachers', 'teachers.id', '=', 'study_groups.teacher_id')
                ->select('study_groups.id', 'study_groups.name', 'study_groups.start', 'study_groups.end', 'study_groups.day', 'seasons.name AS seasons', 'teachers.name AS teacher')
                ->where('courses.id', $id)
                ->get();

            $course->Grades_schema = json_decode($course->Grades_schema, true);

            return view('admin.courses.course-details', ['course' => $course, 'groups' => $groups]);
        } else {
            return back()->withErrors(trans('app.course.not-found'));
        }
    }




    public function edit($id)
    {
        $this->authorize('view', Course::class);

        $levels = StudyLevels::select(['id', 'name', 'code'])->get();

        $course = Course::find($id);
        if ($course) {
            $course->Grades_schema = json_decode($course->Grades_schema, true);
            return view('admin.courses.course-edit', ['course' => $course, 'levels' => $levels]);
        } else {
            return back()->withErrors(trans('app.course.not-found'));
        }
    }



    public function update(Request $request)
    {
        $this->authorize('update', Course::class);

        $data = ($request->all());

        Validator::make($data, [
            'name' => ['required',  'max:255'],
            'code' => ['required', 'string', 'max:255'],
            'level' => ['required', 'string', 'max:255'],
            'final_mark' => ['required', 'numeric', 'max:99999'],
            'sections_num' => ['required', 'numeric', 'max:999'],
            'sections_names' => ['required', 'array', 'max:999'],
            'sections_marks' => ['required', 'array', 'max:999'],
            'id' => [
                'required', 'string',
                function ($attribute, $id, $fail) {
                    $nowDate = Carbon::now()->rawFormat('Y-m-d');
                    // dd($nowDate);
                    $groups_num = DB::table('study_groups')
                        ->join('courses', 'study_groups.course_id', '=', 'courses.id')
                        ->join('seasons', 'seasons.id', '=', 'study_groups.season_id')
                        ->where('courses.id', $id)
                        ->where('seasons.start_date','<=', $nowDate)
                        ->where('seasons.end_date','>=', $nowDate)
                        ->count();
                    if ($groups_num > 0) {
                        $fail("you can not update course details while there is open groups in this semester!!");
                    }
                }
            ],
        ], [], [])->validate();

        $course = Course::find($request->id);

        if ($course) {

            $grades_schema = [];
            $grades_schema['final_mark'] = $data['final_mark'];
            $grades_schema['sections_num'] = $data['sections_num'];

            $grade_sections = [];
            for ($i = 0; $i < sizeof($data['sections_names']); $i++) {
                if (array_search($data['sections_names'][$i], $data['sections_names']) == $i) {
                    $grade_sections[$data['sections_names'][$i]] = $data['sections_marks'][$i];
                } else {
                    $grade_sections[$data['sections_names'][$i] . '-' . $i] = $data['sections_marks'][$i];
                }
            }

            $grades_schema['grade_sections'] = $grade_sections;


            $course->name = $data['name'];
            $course->code = $data['code'];
            $course->level_id = $data['level'];
            $course->Grades_schema = json_encode($grades_schema);

            $course->save();

            return back()->with('success', trans('app.course.updated-successfuly'));
        } else {
            return back()->withErrors(trans('app.course.not-found'));
        }
    }



    public function newCourse()
    {
        $this->authorize('create', Course::class);

        $levels = StudyLevels::select(['id', 'name', 'code'])->get();

        return view('admin.courses.Course-create', ['levels' => $levels]);
    }

    public function create(Request $request)
    {
        $this->authorize('create', Course::class);

        $data = ($request->all());

        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255'],
            'level' => ['required', 'string', 'max:255'],
            'final_mark' => ['required', 'numeric', 'max:99999'],
            'sections_num' => ['required', 'numeric', 'max:999'],
            'sections_names' => ['required', 'array', 'max:999'],
            'sections_marks' => ['required', 'array', 'max:999'],
        ], [], [])->validate();

        // dd(($data['sections_marks']));

        $grades_schema = [];
        $grades_schema['final_mark'] = $data['final_mark'];
        $grades_schema['sections_num'] = $data['sections_num'];

        $grade_sections = [];
        for ($i = 0; $i < sizeof($data['sections_names']); $i++) {
            if (array_search($data['sections_names'][$i], $data['sections_names']) == $i) {
                $grade_sections[$data['sections_names'][$i]] = $data['sections_marks'][$i];
            } else {
                $grade_sections[$data['sections_names'][$i] . '-' . $i] = $data['sections_marks'][$i];
            }
        }

        $grades_schema['grade_sections'] = $grade_sections;

        // dd( json_encode($grades_schema) );
        $Course =  Course::create([
            'name' => $data['name'],
            'code' => $data['code'],
            'level_id' => $data['level'],
            'Grades_schema' => json_encode($grades_schema),

        ]);

        return redirect(route('admin.courses.show'))->with('success', trans('app.course.created-successfuly'));
    }

    public function delete(Request $request)
    {
        $this->authorize('delete', Course::class);

        $data = ($request->all());

        Validator::make($data, [
            'id' => ['required'],
        ], [], [])->validate();
        if (Course::find($request->id)->delete()) {

            return back()->with('success', trans('app.course.deleted-successfuly'));
        } else {
            return back()->withErrors(trans('app.something-went-wrong'));
        }
    }
}
