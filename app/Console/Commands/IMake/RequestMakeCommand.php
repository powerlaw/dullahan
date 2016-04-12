<?php

namespace App\Console\Commands\IMake;

use Illuminate\Console\Command;

class RequestMakeCommand extends IMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imake:request {name} {--delete}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new resource request class';

    public $directory = 'Http/Requests/';

}
