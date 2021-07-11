<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Study_group extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_id',
        'name',
        'teacher_id',
        'season_id',
        'start',
        'end',
        'day',
    ];

    public static function todayEndedGroups($currentSemesters)
    {
        // define week days to use it by Carbon and check if today like stored day in database
        $weekDays = [
            0 => 'sun',
            1 => 'mon',
            2 => 'tue',
            3 => 'wed',
            4 => 'thu',
            5 => 'fri',
            6 => 'sat',
        ];

        $nowTime = Carbon::now()->rawFormat('H:i:s');
        $today = $weekDays[Carbon::now()->dayOfWeek];

        // get today groups which it's ended
        $groups = DB::table('study_groups')
        ->select('study_groups.id')
        ->where('study_groups.day','=', $today)
        ->where('study_groups.end','<=', $nowTime)
        ->whereIn('study_groups.season_id',$currentSemesters)
        ->get();

        // reformat data
        foreach ($groups->toArray() as $key => $value) {
            $groups[$key] = $value->id;
        }

        return $groups;
    }


}
