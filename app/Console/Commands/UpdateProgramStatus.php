<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Program;
use Carbon\Carbon;

class UpdateProgramStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'programs:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set status to 0 for programs that have ended';

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
        $now = Carbon::now();
        
        $count = Program::where('end_time', '<', $now)
            ->where('status', '!=', 'inActived')
            ->update(['status' => 'inActived']);

        $this->info("Updated {$count} programs to status 'inActived'.");

        return 0;
    }
}
