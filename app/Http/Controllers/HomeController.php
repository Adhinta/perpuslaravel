<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\Anggota;
use App\Buku;
use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = Transaksi::get();

        $anggota   = Anggota::get();
        $buku      = Buku::get();


        if(Auth::user()->level == 'user')
        {
            $datas = Transaksi::books([
                'status'=>'pinjam',
                'anggota_id'=>Auth::user()->id
            ]);

        } else {
            $datas = Transaksi::books([
                'status'=>'pinjam'
            ]);
        }
        return view('home', compact('transaksi', 'anggota', 'buku', 'datas'));
    }
}
