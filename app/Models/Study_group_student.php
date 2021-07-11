<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Study_group_student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student',
        'study_group_id',
        'grades',
    ];


    public static function unAttendancedStudents($groups)
    {
        // get students in groups which they don't have attendance records 
        $groupsStudents = DB::table('study_group_students')
        ->select('study_group_students.id', 'study_group_students.student')
        ->leftJoin('attendees', 'study_group_students.id', '=', 'attendees.study_group_students_id')
        ->whereIn('study_group_students.study_group_id',$groups)
        ->where('attendees.id','=', null)
        ->get()->toArray();

        return $groupsStudents;

    }

    


}
