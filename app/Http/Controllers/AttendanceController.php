<?php

namespace App\Http\Controllers;

use App\Models\Attendees;
use App\Models\Season;
use App\Models\Study_group;
use App\Models\Study_group_student;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DatePeriod;
use DateInterval;


class AttendanceController extends Controller
{
    //
    // check students in today finished groups who are not registered for attendance 
    public function CheckAttendanceInEndedGroups()
    {
        
        $currentSemesters = Season::currentSemesters();

        $groups = Study_group::todayEndedGroups($currentSemesters);

        $groupsStudents = Study_group_student::unAttendancedStudents($groups);

        // dd($groupsStudents);

        // create attendance records for students
        foreach ($groupsStudents as $value) {
           Attendees::registerAttendanceAsAbsent($value->id,$value->student);
        }
    }
    

    public function attendanceByStudentGroup($group, $student)
    {
        // dd((new Attendees())->CheckAttendanceInEndedGroups());

        $attedance = DB::table('study_group_students')->select(
            DB::raw('CONCAT( courses.name," / ",study_groups.name) as title'),
            'attendees.attendees_date as date',
            'attendees.status as status',
            'study_groups.day as day')
            ->join('attendees', 'study_group_students.id', '=', 'attendees.study_group_students_id')
            ->join('study_groups', 'study_groups.id', '=', 'study_group_students.study_group_id')
            ->join('courses', 'courses.id', '=', 'study_groups.course_id')
            ->where('study_group_students.student', $student)
            ->where('study_group_students.study_group_id', $group)
            ->get();

            return response()->json([
                'events' => $attedance,
            ]);

            dd($attedance->toArray());
        $season = DB::table('study_groups')->select('seasons.*')
            ->join('seasons', 'seasons.id', '=', 'study_groups.season_id')
            // ->where('study_group.student', $student)
            ->where('study_groups.id', $group)
            ->get()->first();

            $weekDays = [
                0 => 'sun',
                1 => 'mon',
                2 => 'tue',
                3 => 'wed',
                4 => 'thu',
                5 => 'fri',
                6 => 'sat',
            ];
            $end = Carbon::now();
            $begin = Carbon::create($season->start_date);
            $interval = DateInterval::createFromDateString('1 day');
            $period = new DatePeriod($begin, $interval, $end);

            $events = [];

            foreach ($period as $dt) {
                dd($dt->dayOfWeek);
            }

            
            $nowDate = Carbon::now()->rawFormat('Y-m-d');
            $nowTime = Carbon::now()->rawFormat('H:i:s');
            $today = $weekDays[Carbon::now()->dayOfWeek];
            
            // dd($period);



        dd($attedance->toArray());






        return response()->json($attedance);
    }
}
