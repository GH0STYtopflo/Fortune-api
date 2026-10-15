<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    User::onlyTrashed()->where("deleted_at", "<=", now()->minus(days: 120)->toDateTimeString())->forceDelete();
})->cron("0 0 * * *");
