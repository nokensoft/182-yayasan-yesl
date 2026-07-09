<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    /**
     * Hanya menyimpan created_at (tanpa updated_at).
     */
    public const UPDATED_AT = null;

    protected $fillable = [
        'ip_address',
        'visit_date',
    ];

    // Catatan: 'visit_date' sengaja TIDAK di-cast ke 'date' agar tersimpan
    // sebagai string 'Y-m-d' murni. Cast 'date' menghasilkan format
    // datetime ('Y-m-d 00:00:00') yang membuat firstOrCreate gagal
    // mencocokkan baris dan memicu pelanggaran unique constraint.
}
