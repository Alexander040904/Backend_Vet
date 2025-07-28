<?php

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// ✅ Tarea programada correctamente:
Artisan::command('sanctum:prune-expired-task', function () {
    $this->call('sanctum:prune-expired', [
        '--hours' => 24,
    ]);
})->purpose('Eliminar tokens Sanctum vencidos después de 24 horas')
  ->daily(); 