<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';
    protected $fillable = ['no_inventaris', 'judul', 'pengarang', 'tempat_tahun_terbit', 'cetakan_jilid', 'kode', 'asal', 'isbn', 'harga', 'ukuran', 'jumlah_buku'];

    /**
     * Method One To Many 
     */
    public function transaksi()
    {
    	return $this->belongsToMany(Transaksi::class, 'kode_transaksi', 'buku_id');
    }
}
