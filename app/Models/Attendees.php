<?php

namespace App\Models;

use App\Events\AttendanceRegistered;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Attendees extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'study_group_students_id',
        'status',
        'attendees_date',
    ];

    

    // check students in finished groups who are not registered for attendance 
    public static function CheckAttendanceInEndedGroups()
    {
        
        $currentSemesters = Season::currentSemesters();

        $groups = Study_group::todayEndedGroups($currentSemesters);

        $groupsStudents = Study_group_student::unAttendancedStudents($groups);

        // dd($groupsStudents);

        // create attendance records for students
        foreach ($groupsStudents as $value) {
           static::registerAttendanceAsAbsent($value->id,$value->student);
        }

    }


    public static function registerAttendanceAsAbsent($id, $student)
    {
        static::create([
            'study_group_students_id' => $id,
            'status' => 'absent',
            'attendees_date' => Carbon::now()->format('Y-m-d')
        ]);

        event(new AttendanceRegistered($student));
    }
    
    public static function registerAttendanceAsPresent($id)
    {
        static::create([
            'study_group_students_id' => $id,
            'status' => 'present',
            'attendees_date' => Carbon::now()->format('Y-m-d')
        ]);
    }
    
    public static function registerAttendanceAsJustified($id)
    {
        static::create([
            'study_group_students_id' => $id,
            'status' => 'justified',
            'attendees_date' => Carbon::now()->format('Y-m-d')
        ]);
    }

}
