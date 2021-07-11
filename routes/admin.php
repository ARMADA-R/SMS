<?php

use App\Models\User;
use App\Notifications\broadcastNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// }); 

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group([

    'prefix' => 'manager',
    'middleware' => ['setAdminUser','DepugingMiddleware'],

],  function () {

    Config::set('auth.defines', 'admin');

    Route::get('job', function () {

        $job = (new App\Jobs\SendMail('jsgv@skjbv.com', new App\Mail\ClosedAccountMail()));
        dispatch($job);
        echo 'done';
    });

    // Route::get('Support', 'App\Http\Controllers\Admin\AdminsManagerController@support')->name('admin.ContactSupport');
    // login routes
    Route::get('login', 'App\Http\Controllers\Admin\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'App\Http\Controllers\Admin\Auth\LoginController@login');

    //register new admin routes
    // Route::get('register/{token}/{email}', 'App\Http\Controllers\Admin\Auth\RegisterController@showRegistrationForm')->name('admin.register');
    // Route::post('register', 'App\Http\Controllers\Admin\Auth\RegisterController@register');

    //forgot password Routes
    Route::get('password/reset', 'App\Http\Controllers\Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('password/email', 'App\Http\Controllers\Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('password/reset/{token}', 'App\Http\Controllers\Admin\Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('password/reset', 'App\Http\Controllers\Admin\Auth\ResetPasswordController@reset')->name('admin.password.update');

    Route::group(['middleware' => ['admins:admin']], function () {

        // email verifiction routes
        Route::get('email/verify', 'App\Http\Controllers\Admin\Auth\VerificationController@show')->name('admin.verification.notice');
        Route::get('email/verify/{id}/{hash}', 'App\Http\Controllers\Admin\Auth\VerificationController@verify')->name('admin.verification.verify');
        Route::post('email/resend', 'App\Http\Controllers\Admin\Auth\VerificationController@resend')->name('admin.verification.resend');


        //admin logout route
        Route::post('logout', 'App\Http\Controllers\Admin\Auth\LoginController@logout')->name('admin.logout');

        //closed account route
        // Route::get('account/closed', 'App\Http\Controllers\Admin\UsersManagerController@ShowClosedAccountView')->name('admin.closedAccount');


        Route::group(['middleware' => []], function () {
            Route::get('/', function () {
                return view('admin.home');
            })->name('admin.home');
        });


        Route::get('users', 'App\Http\Controllers\UsersController@getUsers')->name('admin.Users');
        Route::get('users/account/details/{id}', 'App\http\controllers\UsersController@accountDetails')->name('admin.UserAccountDetails');
        Route::get('users/account/edit/{id}', 'App\http\controllers\UsersController@editAccountGET')->name('admin.UsersAccountEdit');
        Route::post('users/account/edit', 'App\http\controllers\UsersController@editAccountPOST')->name('admin.updateAccountDetails');
        Route::post('users/account/edit/password', 'App\http\controllers\UsersController@UpdateAcountPassword')->name('admin.updateAccountPassword');
        Route::post('account/close', 'App\Http\Controllers\UsersController@closeAccount')->name('admin.CloseUserAccount');
        Route::post('account/activate', 'App\Http\Controllers\UsersController@activateAccount')->name('admin.ActivateUserAccount');
        Route::get('users/create', 'App\http\controllers\UsersController@createGet')->name('admin.account.create');
        Route::post('users/create', 'App\http\controllers\UsersController@create');



        Route::get('students', 'App\Http\Controllers\StudentsController@getStudents')->name('admin.Students');
        Route::get('students/edit/{id}', 'App\http\controllers\StudentsController@edit')->name('admin.student.edit');
        Route::post('students/edit/{id}', 'App\http\controllers\StudentsController@update');
        Route::get('students/create', 'App\http\controllers\StudentsController@newStudent')->name('admin.student.create');
        Route::post('students/create', 'App\http\controllers\StudentsController@create');
        Route::post('students/create/excel', 'App\http\controllers\StudentsController@createExcel')->name('admin.student.create.excel');

        


        Route::get('teachers', 'App\Http\Controllers\TeachersController@getTeachers')->name('admin.Teachers');
        Route::get('teachers/edit/{id}', 'App\http\controllers\TeachersController@edit')->name('admin.teacher.edit');
        Route::post('teachers/edit/{id}', 'App\http\controllers\TeachersController@update');
        Route::get('teachers/create', 'App\http\controllers\TeachersController@newTeacher')->name('admin.teacher.create');
        Route::post('teachers/create', 'App\http\controllers\TeachersController@create');
        Route::post('teachers/create/excel', 'App\http\controllers\TeachersController@createExcel')->name('admin.teacher.create.excel');

        

        Route::get('roles', 'App\Http\Controllers\Admin\RolesController@roles')->name('admin.showRoles');
        Route::get('roles/details/{id}', 'App\Http\Controllers\Admin\RolesController@details')->name('admin.roleDetails');
        Route::get('roles/edit/{id}', 'App\Http\Controllers\Admin\RolesController@edit')->name('admin.roleEdit');
        Route::post('roles/edit', 'App\Http\Controllers\Admin\RolesController@update')->name('admin.roleUpdate');
        Route::get('roles/create', 'App\Http\Controllers\Admin\RolesController@newRole')->name('admin.roleCreate');
        Route::post('roles/create', 'App\Http\Controllers\Admin\RolesController@create');
        Route::post('roles/delete', 'App\Http\Controllers\Admin\RolesController@delete')->name('admin.deleteRole');
        
        
        Route::get('seasons', 'App\Http\Controllers\Admin\SeasonsController@seasons')->name('admin.seasons.show');
        Route::get('seasons/edit/{id}', 'App\Http\Controllers\Admin\SeasonsController@edit')->name('admin.seasons.edit');
        Route::post('seasons/edit', 'App\Http\Controllers\Admin\SeasonsController@update')->name('admin.seasons.update');
        Route::get('seasons/create', 'App\Http\Controllers\Admin\SeasonsController@newSeason')->name('admin.seasons.create');
        Route::post('seasons/create', 'App\Http\Controllers\Admin\SeasonsController@create');
        Route::post('seasons/delete', 'App\Http\Controllers\Admin\SeasonsController@delete')->name('admin.seasons.delete');
        
        
        
        Route::get('courses', 'App\Http\Controllers\Admin\CourseController@courses')->name('admin.courses.show');
        Route::get('courses/details/{id}', 'App\Http\Controllers\Admin\CourseController@details')->name('admin.courses.details');
        Route::get('courses/edit/{id}', 'App\Http\Controllers\Admin\CourseController@edit')->name('admin.courses.edit');
        Route::post('courses/edit', 'App\Http\Controllers\Admin\CourseController@update')->name('admin.courses.update');
        Route::get('courses/create', 'App\Http\Controllers\Admin\CourseController@newCourse')->name('admin.courses.create');
        Route::post('courses/create', 'App\Http\Controllers\Admin\CourseController@create');
        Route::post('courses/delete', 'App\Http\Controllers\Admin\CourseController@delete')->name('admin.courses.delete');
        
        Route::get('courses/{id}/group/create', 'App\Http\Controllers\Admin\CourseGroupsController@newGroup')->name('admin.course.group.create');
        Route::post('courses/{id}/group/create', 'App\Http\Controllers\Admin\CourseGroupsController@create');
        Route::get('courses/{id}/group/edit', 'App\Http\Controllers\Admin\CourseGroupsController@edit')->name('admin.course.group.edit');
        Route::post('courses/{id}/group/edit', 'App\Http\Controllers\Admin\CourseGroupsController@update');
        Route::post('courses/group/delete', 'App\Http\Controllers\Admin\CourseGroupsController@delete')->name('admin.course.group.delete');
        Route::get('courses/group/{id}/details', 'App\Http\Controllers\Admin\CourseGroupsController@details')->name('admin.course.group.details');
        Route::get('courses/group/{id}/students', 'App\Http\Controllers\Admin\CourseGroupsController@getGroupStudents')->name('admin.course.group.students');
        Route::post('courses/group/{id}/students/remove', 'App\Http\Controllers\Admin\CourseGroupsController@removeStudentFromGroup')->name('admin.course.group.student.remove');
        Route::get('courses/group/{id}/students/add', 'App\Http\Controllers\Admin\CourseGroupsController@addStudentToGroup')->name('admin.course.group.student.add-students');
        Route::get('courses/group/{id}/students/add/data', 'App\Http\Controllers\Admin\CourseGroupsController@addStudentToGroupData')->name('admin.course.group.student.add-students.data');
        Route::post('courses/group/{id}/students/add/data', 'App\Http\Controllers\Admin\CourseGroupsController@addStudentToGroupPOST');
        Route::get('courses/group/{group_id}/student/{student_id}/details', 'App\Http\Controllers\Admin\CourseGroupsController@groupStudentDetails')->name('admin.course.group.student.details');
        Route::get('courses/group/{group_id}/student/{student_id}/edit', 'App\Http\Controllers\Admin\CourseGroupsController@groupStudentEdit')->name('admin.course.group.student.edit');
        Route::post('courses/group/{group_id}/student/{student_id}/edit', 'App\Http\Controllers\Admin\CourseGroupsController@groupStudentUpdate');
        
        
        Route::get('app/settings', 'App\Http\Controllers\Admin\AppSettings@showSettingsForm')->name('admin.appSettings');
        // Route::post('app/settings/timezone', 'App\Http\Controllers\Admin\AppSettings@updateTimezone')->name('admin.settings.updateTimezone');
        Route::post('app/settings/basics', 'App\Http\Controllers\Admin\AppSettings@updateBasics')->name('admin.settings.updateBasics');
        Route::post('app/settings/maintenance', 'App\Http\Controllers\Admin\AppSettings@updateMaintenance')->name('admin.settings.updateMaintenanceMode');
        Route::post('app/settings/options', 'App\Http\Controllers\Admin\AppSettings@updateOptions')->name('admin.settings.updateOptions');
        


        Route::get('attendance/group/{group_id}/student/{student_id}/get', 'App\Http\Controllers\AttendanceController@attendanceByStudentGroup')->name('admin.attendance.getBy.group.student');
        
        Route::get('attendance/group/{group_id}/student/{student_id}/edit', 'App\Http\Controllers\AttendanceController@attendanceByStudentGroup')->name('admin.attendance.getBy.group.student.edit');
        
        Route::get('test', function () {
            
            $user = User::find(8);
            
            Notification::send($user, new broadcastNotification($user));
            
            // dd(env('PUSHER_APP_KEY',''), env('PUSHER_APP_CLUSTER',''), env('APP_KEY'));
            // event(new App\Events\StatusLiked('Someone'));
            return "Event has been sent!";
        });
        
        Route::get('notifications/get', 'App\Http\Controllers\NotificationsController@getUserNotifications')->name('admin.notifications.get');
        Route::get('notifications/read/all', 'App\Http\Controllers\NotificationsController@markAllAsRead')->name('admin.notifications.read');

    });
});
