<?php

if (!function_exists('assetSubmissionPhoto')) {
    function assetSubmissionPhoto(string $path): string
    {
        $env = app()->environment();

        // If running locally, use /storage
        if ($env === 'local') {
            return asset('storage/' . $path);
        }

        // On production (or staging), use /public
        return asset('public/' . $path);
    }
}
