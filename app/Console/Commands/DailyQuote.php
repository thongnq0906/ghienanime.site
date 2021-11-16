<?php

namespace App\Console\Commands;

use App\Models\Check_movie;
use Carbon\Carbon;
use Goutte\Client;
use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Images;
use App\User;
use Illuminate\Support\Facades\Hash;

class DailyQuote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:daily';

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
        \Log::info("Cron is working fine!");
    }
}

