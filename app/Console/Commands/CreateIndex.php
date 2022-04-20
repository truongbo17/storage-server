<?php

namespace App\Console\Commands;

use Elasticsearch\Client;
use Illuminate\Console\Command;

class CreateIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:index {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an index';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Client $client)
    {
        $client->indices()->create([
            'index' => $this->argument('name')
        ]);
    }
}
