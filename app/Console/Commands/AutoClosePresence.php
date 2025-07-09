<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Presence;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;

// class AutoClosePresence extends Command
// {
//     protected $signature = 'presence:auto-close';
//     protected $description = 'Automatically close presence sessions after 2 hours';

//     public function handle()
//     {
//         $twoHoursAgo = now()->subHours(2);

//         $closed = Presence::whereNull('closed_at')
//             ->where('opened_at', '<=', $twoHoursAgo)
//             ->update(['closed_at' => now()]);

//         $this->info("✅ Closed $closed presence session(s).");
//     }

//     public function schedule(Schedule $schedule): void
//     {
//             $schedule->command(static::class)->everyMinute();
//     }
// }

class AutoClosePresence extends Command
{
    protected $signature = 'presence:auto-close';
    protected $description = 'Automatically close presence sessions after 1 minute (for testing)';

    public function handle()
    {
        // $oneMinuteAgo = now()->subMinute();
        $twoHoursAgo = now()->subHours(2);

        $closed = Presence::whereNull('closed_at')
            // ->where('opened_at', '<=', $oneMinuteAgo)
            ->where('opened_at', '<=', $twoHoursAgo)
            ->update(['closed_at' => now()]);

        $this->info("✅ Closed $closed presence session(s).");
    }

    public function schedule(Schedule $schedule): void
    {
        $schedule->command(static::class)->everyMinute();
    }
}
