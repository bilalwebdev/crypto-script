<?php

namespace App\Console\Commands;

use App\Models\CommisionSetting;
use App\Models\User;
use Illuminate\Console\Command;

class Commision extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'commision:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Commision added!';

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
     * @return int
     */
    public function handle()
    {






        return 0;
    }
}
