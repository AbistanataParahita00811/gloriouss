<?php

use Illuminate\Support\Facades\Storage;

if (! function_exists('storage_public_url')) {
    /**
     * URL publik untuk file di disk `public` (local atau Supabase S3).
     */
    function storage_public_url(?string $path): ?string
    {
        if (blank($path)) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        try {
            return Storage::disk('public')->url($path);
        } catch (Throwable $e) {
            return rtrim((string) config('app.url'), '/').'/storage/'.ltrim($path, '/');
        }
    }
}

if (! function_exists('storage_public_base_url')) {
    function storage_public_base_url(): string
    {
        try {
            return rtrim(Storage::disk('public')->url('/'), '/');
        } catch (Throwable $e) {
            return rtrim((string) config('app.url'), '/').'/storage';
        }
    }
}

if (! function_exists('get_favicon_url')) {
    function get_favicon_url()
    {
        $logoPath = config('app.logo');

        if ($logoPath) {
            $url = storage_public_url($logoPath);

            return $url ? $url.'?v='.time() : asset('favicon.ico');
        }

        return asset('favicon.ico');
    }
}
