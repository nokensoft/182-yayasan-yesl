<?php

namespace App\Providers;

use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('partials.footer', function ($view) {
            $view->with('visitorStats', $this->visitorStats());
        });
    }

    /**
     * Statistik pengunjung unik (berdasarkan IP) per periode.
     *
     * Dibungkus cache 5 menit + try/catch agar footer tetap aman bila
     * tabel belum dimigrasi atau terjadi error database.
     *
     * @return array{today:int, week:int, month:int, year:int}
     */
    protected function visitorStats(): array
    {
        $default = ['today' => 0, 'week' => 0, 'month' => 0, 'year' => 0];

        try {
            return Cache::remember('visitor_stats', 300, function () {
                $now = Carbon::today();

                $countSince = fn (Carbon $from): int => Visitor::query()
                    ->whereDate('visit_date', '>=', $from->toDateString())
                    ->distinct('ip_address')
                    ->count('ip_address');

                return [
                    'today' => $countSince($now),
                    'week' => $countSince($now->copy()->startOfWeek()),
                    'month' => $countSince($now->copy()->startOfMonth()),
                    'year' => $countSince($now->copy()->startOfYear()),
                ];
            });
        } catch (\Throwable $e) {
            return $default;
        }
    }
}
