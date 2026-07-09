<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Catat satu kunjungan unik per IP per hari.
     *
     * Aman untuk production: seluruh proses dibungkus try/catch sehingga
     * kegagalan pencatatan (mis. tabel belum dimigrasi) tidak mengganggu
     * response yang dikirim ke pengunjung.
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // Hanya untuk request GET biasa yang mengembalikan HTML.
            // Dicatat SEBELUM response dirender agar statistik pengunjung di
            // footer (dihitung saat view dirender) sudah menyertakan kunjungan
            // ini -> angka "Hari Ini" langsung terhitung, bukan tertinggal satu
            // request atau menunggu cache statistik kedaluwarsa.
            if ($request->isMethod('GET') && ! $request->ajax()) {
                $this->record($request);
            }
        } catch (\Throwable $e) {
            // Abaikan: tracking tidak boleh mengganggu pengalaman pengunjung.
        }

        return $next($request);
    }

    protected function record(Request $request): void
    {
        $ip = $request->ip();

        if (! $ip) {
            return;
        }

        $today = Carbon::today()->toDateString();
        $cacheKey = "visitor:{$ip}:{$today}";

        // Sudah tercatat hari ini -> lewati penulisan DB.
        if (Cache::has($cacheKey)) {
            return;
        }

        $visitor = Visitor::firstOrCreate([
            'ip_address' => $ip,
            'visit_date' => $today,
        ]);

        // Tandai sampai akhir hari agar tidak menulis DB berulang.
        Cache::put($cacheKey, true, Carbon::now()->endOfDay());

        // Kunjungan baru -> segarkan cache statistik footer agar angka
        // langsung ter-update tanpa menunggu TTL 5 menit kedaluwarsa.
        if ($visitor->wasRecentlyCreated) {
            Cache::forget('visitor_stats');
        }
    }
}
