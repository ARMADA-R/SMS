<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group([

//     'prefix' => 'manager',
//     'middleware' => ['setAdminUser'],

// ],  function () {
//     Config::set('auth.defines', 'admin');
//     Route::group(['middleware' => ['admins:admin']], function () {
//         Route::get('attendance/group/{group_id}/student/{student_id}/get', 'App\Http\Controllers\AttendanceController@attendanceByStudentGroup')->name('api.admin.attendance.getBy.group.student');
//     });
// });
