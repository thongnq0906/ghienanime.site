<?php

namespace App\Console;

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
        Commands\DailyQuote::class,
        Commands\CreateAnime::class,
        Commands\UpdateAnime::class,
        Commands\CheckNinja::class,
        Commands\UpdateNinja::class,
        Commands\CreateTvhay::class,
        Commands\ResetNinja::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('quote:daily')
            ->everyMinute();
        $schedule->command('create:anime')
            ->hourly();
        $schedule->command('update:anime')
            ->hourly();
        $schedule->command('create:tvhay')
            ->hourly();
        $schedule->command('reset:ninja')
            ->hourly();
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
