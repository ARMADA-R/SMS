<?php

namespace App\Console;

use App\Http\Controllers\AttendanceController;
use App\Models\Attendees;
use App\Models\Students;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            if (isset(settings()['scheduling_attendance']) && (settings()['scheduling_attendance'])) {
                // (new AttendanceController())->CheckAttendanceInEndedGroups();
                $s = Students::find(1);
                $s->first_name = 'inside';
                $s->save();
            }
        })->everyTwoMinutes();

        if (isset(settings()['scheduling_attendance']) && (settings()['scheduling_attendance'])) {
            $schedule->call(function () {
                // (new AttendanceController())->CheckAttendanceInEndedGroups();
                $s = Students::find(1);
                $s->first_name = 'outside';
                $s->save();
            })->everyMinute();
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
