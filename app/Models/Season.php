<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'year',
        'start_date',
        'end_date',
    ];

    // get the current semesters
    public static function currentSemesters()
    {
        $nowDate = Carbon::now()->rawFormat('Y-m-d');
        $currentSemesters = DB::table('seasons')->select('seasons.id')
        ->where('seasons.start_date','<=', $nowDate)
        ->where('seasons.end_date','>=', $nowDate)
        ->get()->toArray();

        foreach ($currentSemesters as $key => $value) {
            $currentSemesters[$key] =  $value->id;
        }

        return $currentSemesters;
    }
}
