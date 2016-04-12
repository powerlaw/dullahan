<?php

namespace App\Console\Commands\IMake;

use Illuminate\Console\Command;

class ControllerMakeCommand extends IMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imake:controller {name} {--delete}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new resource controller class';

    public $directory = 'Http/Controllers/';

}
