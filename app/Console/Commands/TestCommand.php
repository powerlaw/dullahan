<?php

namespace App\Console\Commands;

use App\Models\Staging\Good;
use App\Utils\CurlUtil;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('test');
//        $curlUtil = new CurlUtil('https://github.com/thephpleague/skeleton/archive/master.zip');
////        $curlUtil = new CurlUtil('https://github.com');
//        $response = $curlUtil->exec(['body','header','locations','httpCode','totalTime']);
//        $curlUtil->close();
//        var_dump($response);

    }
}
