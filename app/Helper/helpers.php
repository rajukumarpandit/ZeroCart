<?php
use Illuminate\Support\Facades\Cache;

function isUserOnline($userId)
{
    return Cache::has('user-is-online-' . $userId);
}

function auditLog(string $message, $model = null, array $properties = [])
{
    activity()
        ->causedBy(auth()->user())
        ->performedOn($model)
        ->withProperties($properties)
        ->log($message);
}
function activityIcon($log) {
    return match(true) {
        str_contains($log, 'logged in') => ['bi-box-arrow-in-right', 'bg-success'],
        str_contains($log, 'logged out') => ['bi-box-arrow-left', 'bg-secondary'],
        str_contains($log, 'created') => ['bi-plus-circle', 'bg-primary'],
        str_contains($log, 'updated') => ['bi-pencil-square', 'bg-warning'],
        str_contains($log, 'deleted') => ['bi-trash', 'bg-danger'],
        default => ['bi-activity', 'bg-info'],
    };
}