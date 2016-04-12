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
        // Commands\Inspire::class,
        Commands\TestCommand::class,
        Commands\IMake\RepositoryMakeCommand::class,
        Commands\IMake\ModelMakeCommand::class,
        Commands\IMake\ControllerMakeCommand::class,
        Commands\IMake\RequestMakeCommand::class,
        Commands\IMake\SeederMakeCommand::class,
        Commands\SwaggerCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }
}
