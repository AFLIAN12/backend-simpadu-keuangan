<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeuPembayaran extends Model
{
    protected $table = 'keu_pembayaran';
    protected $fillable = ['nim', 'kategori_ukt_id', 'tanggal_pembayaran', 'jumlah', 'metode_pembayaran'];
}

