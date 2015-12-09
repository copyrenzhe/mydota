<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\HeroDb;
use App\Repositories\ItemsDb;
use App\Repositories\AbilityDb;

class Sync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'data sync';

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
        $itemDb = new ItemDb();
        $heroDb = new HeroDb();
        $abilityDb = new AbilityDb();
        $itemDb->update();
        $heroDb->update();
        $abilityDb->update();
    }
}
