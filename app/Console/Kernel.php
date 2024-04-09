<?php

namespace App\Console;

use App\Console\Commands\Meme\CheckThreadCommand;
use App\Console\Commands\Meme\LoadCommand;
use App\Console\Commands\Meme\SendCommand;
use App\Console\Commands\TrolloloCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(SendCommand::class)->everyFiveMinutes()->runInBackground();
        $schedule->command(LoadCommand::class)->cron('0 */1 * * *')->runInBackground();
        $schedule->command(CheckThreadCommand::class)->everyFiveMinutes()->runInBackground();
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
