<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Buku;
use App\Anggota;
use App\Transaksi;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
use PhpParser\Node\Stmt\Catch_;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        Transaksi::books();
        if (Auth::user()->level == 'user') {
            $trx = Transaksi::books(['anggota_id'=>Auth::user()]);
        } else {
            $trx = Transaksi::books();
        }

        return view('transaksi.index', ['datas'=>$trx]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getRow = Transaksi::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();
        
        $lastId = $getRow->first();

        $kode = "TR00001";
        
        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                $kode = "TR0000".''.($lastId->id + 1);
            } elseif ($lastId->id < 99) {
                $kode = "TR000".''.($lastId->id + 1);
            } elseif ($lastId->id < 999) {
                $kode = "TR00".''.($lastId->id + 1);
            } elseif ($lastId->id < 9999) {
                $kode = "TR0".''.($lastId->id + 1);
            } else {
                $kode = "TR".''.($lastId->id + 1);
            }
        }

        $bukus = Buku::where('jumlah_buku', '>', 0)->get();
        $anggotas = Anggota::get();
        return view('transaksi.create', compact('bukus', 'kode', 'anggotas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_transaksi' => 'required|string|max:255',
            'tgl_pinjam' => 'required',
            'tgl_kembali' => 'required',
            'buku_id' => 'required',
            'anggota_id' => 'required',

        ]);

        $bukus = explode(",", $request->buku_id);
        
        // Masukan transaksi terlebih dahulu
        $transaksi = new Transaksi();
        $transaksi->kode_transaksi = $request->get('kode_transaksi');
        $transaksi->tgl_pinjam = $request->get('tgl_pinjam');
        $transaksi->tgl_kembali = $request->get('tgl_kembali');
        $transaksi->anggota_id = $request->get('anggota_id');
        $transaksi->ket = $request->get('ket');
        $transaksi->status = 'pinjam';
        
        if($transaksi->save()){
            foreach ($bukus as $id_buku) {

                try {
                    // Masukan kode_transaksi dan id_buku ke buku_transaksi
                    $insertedBook = DB::table('buku_transaksi')->insert([
                        'kode_transaksi'=>$transaksi->kode_transaksi,
                        'buku_id'=>$id_buku
                    ]);

                    // Update jumlah buku tersedia
                    $book = DB::table('buku')->where('id', $id_buku)->first();
                    $updateBook = Buku::find($book->id);
                    $updateBook->jumlah_buku = ($book->jumlah_buku - 1);
                    $updateBook->save();

                } catch(\Illuminate\Database\QueryException $e) {
                    return response()->json([
                        'success'=>false
                    ]);
                }
            }

        }



        return response()->json([
            'success'=>true,
        ]);
        // alert()->success('Berhasil.', 'Data telah ditambahkan!');
        // return redirect()->route('transaksi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trx = Transaksi::findOrFail($id);

        $t = DB::table('buku_transaksi')
            ->leftJoin('buku', 'buku.id', '=', 'buku_transaksi.buku_id')
            ->where(['kode_transaksi'=>$trx->kode_transaksi])->get();
        
        $trx->buku = $t;


        if ((Auth::user()->level == 'user') && (Auth::user()->anggota->id != $data->anggota_id)) {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }


        return view('transaksi.show', ['data'=>$trx]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Transaksi::findOrFail($id);

        if ((Auth::user()->level == 'user') && (Auth::user()->anggota->id != $data->anggota_id)) {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }

        return view('buku.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Ubah data menjadi kembai
        $transaksi = Transaksi::find($id);
        $transaksi->status = 'kembali';
        $transaksi->save();


        // Kembalikan jumlah buku yang kembali
        $trx = Transaksi::books(['id'=>$id])->first();
        foreach($trx->buku as $book){
            // dd($book->id);
            $b = Buku::find($book->id);
            // dd($b);
            $b->jumlah_buku = ($book->jumlah_buku + 1);
            $b->save();
        }
        alert()->success('Berhasil.', 'Data telah diubah!');
        return redirect()->route('transaksi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $trx = Transaksi::find($id);
        $trx = Transaksi::find($id);
        DB::table('buku_transaksi')->where(['kode_transaksi'=>$trx->kode_transaksi])->delete();
        $trx->delete();
        
        alert()->success('Berhasil.', 'Data telah dihapus!');
        return redirect()->route('transaksi.index');
    }
}
