<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Buku;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use Excel;
use RealRashid\SweetAlert\Facades\Alert;

class BukuController extends Controller
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
        if(Auth::user()->level == 'user') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }

        $datas = Buku::get();
        return view('buku.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->level == 'user') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }

        return view('buku.create');
    }


    public function import(Request $request)
    {
        $this->validate($request, [
            'importBuku' => 'required'
        ]);

        if ($request->hasFile('importBuku')) {
            $path = $request->file('importBuku')->getRealPath();

            $data = Excel::load($path, function($reader){})->get();
            $a = collect($data);

            if (!empty($a) && $a->count()) {
                foreach ($a as $key => $value) {
                    $insert[] = [
                            'no_inventaris' => $value->no_inventaris, 
                            'judul' => $value->judul, 
                            'pengarang' => $value->pengarang, 
                            'tempat_tahun_terbit' => $value->tempat_tahun_terbit,
                            'cetakan_jilid' => $value->cetakan_jilid, 
                            'kode' => $value->kode, 
                            'asal' => $value->asal,
                            'isbn' => $value->isbn, 
                            'harga' => $value->harga, 
                            'ukuran' => $value->ukuran,
                            'jumlah_buku' => $value->jumlah_buku ];

                    Buku::create($insert[$key]);
                        
                    }
                  
            };
        }
        alert()->success('Berhasil.','Data telah diimport!');
        return back();
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
            'judul' => 'required|string|max:255',
            'isbn' => 'required|string'
        ]);

        if($request->file('cover')) {
            $file = $request->file('cover');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('cover')->move("images/buku", $fileName);
            $cover = $fileName;
        } else {
            $cover = NULL;
        }

        Buku::create([
                'no_inventaris' => $request->get('no_inventaris'),
                'judul' => $request->get('judul'),
                'pengarang' => $request->get('pengarang'),
                'tempat_tahun_terbit' => $request->get('tempat_tahun_terbit'),
                'cetakan_jilid' => $request->get('cetakan_jilid'),
                'kode' => $request->get('kode'),
                'asal' => $request->get('asal'),
                'isbn' => $request->get('isbn'),
                'harga' => $request->get('harga'),
                'ukuran' => $request->get('ukuran'),
                'jumlah_buku' => $request->get('jumlah_buku')
            ]);

        alert()->success('Berhasil.','Data telah ditambahkan!');

        return redirect()->route('buku.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->level == 'user') {
                Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
                return redirect()->to('/');
        }

        $data = Buku::findOrFail($id);

        return view('buku.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        if(Auth::user()->level == 'user') {
                Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
                return redirect()->to('/');
        }

        $data = Buku::findOrFail($id);
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
        if($request->file('cover')) {
            $file = $request->file('cover');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('cover')->move("images/buku", $fileName);
            $cover = $fileName;
        } else {
            $cover = NULL;
        }

        Buku::find($id)->update([

                'no_inventaris' => $request->get('no_inventaris'),
                'judul' => $request->get('judul'),
                'pengarang' => $request->get('pengarang'),
                'tempat_tahun_terbit' => $request->get('tempat_tahun_terbit'),
                'cetakan_jilid' => $request->get('cetakan_jilid'),
                'kode' => $request->get('kode'),
                'asal' => $request->get('asal'),
                'isbn' => $request->get('isbn'),
                'harga' => $request->get('harga'),
                'ukuran' => $request->get('ukuran'),
                'jumlah_buku' => $request->get('jumlah_buku')
                ]);

        alert()->success('Berhasil.','Data telah diubah!');
        return redirect()->route('buku.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Buku::find($id)->delete();
        alert()->success('Berhasil.','Data telah dihapus!');
        return redirect()->route('buku.index');
    }
}
