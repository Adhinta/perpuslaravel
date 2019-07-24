<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = ['kode_transaksi', 'anggota_id', 'buku_id', 'tgl_pinjam', 'tgl_kembali', 'status', 'ket'];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    public static function books($args = null){
        if($args == null){
            $trx = Transaksi::get();
        } else {
            $trx = Transaksi::where($args)->get();
        }

        foreach($trx as $tr){
            // $tr->buku = new \stdClass();
            $t = DB::table('buku_transaksi')
                ->leftJoin('buku', 'buku.id', '=', 'buku_transaksi.buku_id')
                ->where(['kode_transaksi'=>$tr->kode_transaksi])->get();
            
            $tr->buku = $t;
        }
        
        return $trx;
    }
    // Benerin tabel dulu soalnya susah pakai many to many pakai tabel yg sekarang
    // public function buku()
    // {
        // $a = $this->belongsToMany(Buku::class, 'transaksi');
        // dd($a->first());
        // return $a;
    // }
}
