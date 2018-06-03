<?php

namespace App\Console;

use App\Console\Commands\MinerCycle;
use App\Console\Commands\TodayPrice;
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
        Commands\Inspire::class,
        MinerCycle::class,
        TodayPrice::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')
                 ->hourly();

        $schedule->command('miner:cycle')->everyMinute();
        $schedule->command('price:today')->dailyAt("00:10");
    }
}
