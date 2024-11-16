<?php
use App\Console\Commands\SendMailComand;
use App\MyClass;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Definimos el comando 'inspire'
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Definimos el comando 'reminders:send'
Schedule::command(SendMailComand::class)
    ->everyMinute();

Schedule::call(function () {
    logger('function only');
})->everyMinute();

Schedule::call(function () {
    $myClass = app()->make(\App\MyClass::class);
    $myClass();
})->dailyAt('08:00')->timezone('America/Mexico_City');


Schedule::exec('echo "Hello World"')->everyMinute();
