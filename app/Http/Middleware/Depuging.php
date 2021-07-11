<?php

namespace App\Http\Middleware;

use App\Jobs\SendStudentsAttendanceNotification;
use App\Models\Students;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Depuging
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // $res = Students::create([
        //     'first_name' => 'delete',
        //     'last_name' => 'delete',
        //     'father_name' => 'delete',
        //     'mother_name' => 'delete',
        //     'level_id' => 1,
        // ]);

        // dd('Depuging Middleware', $res);
        
        // $res = DB::table('students')->insertGetId([
        //     'first_name' => "delete",
        //     'last_name' => "delete",
        //     'father_name' => "delete",
        //     'mother_name' => "delete",
        //     'level_id' => 1
        // ]);
        // dd($res);
        
        // $user = User::select('users.*')
        // ->join('students', 'users.id', '=', 'students.user_id')
        // ->where('students.id', 1)
        // ->get();

        
        // dispatch((new SendStudentsAttendanceNotification($user))->toMail($user));


        return $next($request);
    }
}
