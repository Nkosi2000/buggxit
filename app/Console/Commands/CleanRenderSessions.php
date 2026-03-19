<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanRenderSessions extends Command
{
    protected $signature = 'sessions:clean-render';
    protected $description = 'Clean up sessions created by Render health checks';

    public function handle()
    {
        $deleted = DB::table('sessions')
            ->where('user_agent', 'like', '%Render/1.0%')
            ->whereNull('user_id')
            ->delete();

        $this->info("Deleted {$deleted} Render sessions.");
        
        return 0;
    }
}