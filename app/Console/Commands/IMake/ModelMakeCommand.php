<?php

namespace App\Console\Commands\IMake;

use Illuminate\Console\Command;

class ModelMakeCommand extends IMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imake:model {name} {--delete}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new resource model class';

    public $directory = 'Models/';

}
