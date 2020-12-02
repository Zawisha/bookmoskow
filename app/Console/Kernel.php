<?php

namespace App\Console;

//use App\Console\Commands\SetTime;
//use App\Console\Commands\TestApi;
use App\DropCart;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
//        TestApi::class,
//        SetTime::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

//        $schedule ->command(TestApi::class)->everyMinute()->appendOutputTo(storage_path('logs/examplecommand.log'));
//        $schedule ->command(SetTime::class)->everyMinute();
//
        $schedule->call('App\Http\Controllers\IndexController@test_api')
//            ->everyFiveMinutes();
        ->cron('* * * * * *');

        $schedule->call('App\Http\Controllers\IndexController@set_time')
//            ->everyMinute();
        ->cron('15 * * * * *');

//        $schedule->call('App\Http\Controllers\IndexController@set_time')
//            ->withoutOverlapping($schedule)
//            ->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
