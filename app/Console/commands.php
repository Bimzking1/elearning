<?php

use App\Console\Commands\AutoClosePresence;

return function (Illuminate\Console\Scheduling\Schedule $schedule) {
    // Register schedule here
    $schedule->command(AutoClosePresence::class)->everyMinute();
};
