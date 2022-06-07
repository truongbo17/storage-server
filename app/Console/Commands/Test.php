<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\TruongBo\StopWords\StopWords;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:stopword';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        dd(StopWords::input('The about 0 My . . . tailor is rich rich and Alison is in the kitchen with Bob.','en',true));
    }
}
