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
use Excel;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;

class LaporanController extends Controller
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

    public function anggota()
    {
        return view('laporan.anggota');
    }

    public function anggotaPdf()
    {

        $datas = anggota::all();
        $pdf = PDF::loadView('laporan.anggota_pdf', compact('datas'));
        return $pdf->download('laporan_anggota_'.date('Y-m-d_H-i-s').'.pdf');
    }

    public function anggotaExcel(Request $request)
    {
        $nama = 'laporan_anggota_'.date('Y-m-d_H-i-s');
        Excel::create($nama, function ($excel) use ($request) {
        $excel->sheet('Laporan Data Anggota', function ($sheet) use ($request) {
        
        $sheet->mergeCells('A1:H1');

       // $sheet->setAllBorders('thin');
        $sheet->row(1, function ($row) {
            $row->setFontFamily('Calibri');
            $row->setFontSize(11);
            $row->setAlignment('center');
            $row->setFontWeight('bold');
        });

        $sheet->row(1, array('LAPORAN DATA ANGGOTA'));

        $sheet->row(2, function ($row) {
            $row->setFontFamily('Calibri');
            $row->setFontSize(11);
            $row->setFontWeight('bold');
        });

        $datas = anggota::all();

       // $sheet->appendRow(array_keys($datas[0]));
        $sheet->row($sheet->getHighestRow(), function ($row) {
            $row->setFontWeight('bold');
        });

         $datasheet = array();
         $datasheet[0]  =   array("NO", "NAMA", "STATUS", "NIS",  "TEMPAT LAHIR","TANGGAL LAHIR","JENIS KELAMIN", "JABATAN");
         $i=1;

        foreach ($datas as $data) {

           // $sheet->appendrow($data);
          $datasheet[$i] = array($i,
                        $data['nama'],
                        $data['status'],
                        $data['npm'],
                        $data['tempat_lahir'],
                        $data['tgl_lahir'],
                        $data['jk'],
                        $data['jabatan']
                    );
          
          $i++;
        }

        $sheet->fromArray($datasheet);
    });

})->export('xls');

}

    public function buku()
    {
        return view('laporan.buku');
    }

    public function bukuPdf()
    {

        $datas = Buku::all();
        $pdf = PDF::loadView('laporan.buku_pdf', compact('datas'));
        return $pdf->download('laporan_buku_'.date('Y-m-d_H-i-s').'.pdf');
    }

    public function bukuExcel(Request $request)
    {
        $nama = 'laporan_buku_'.date('Y-m-d_H-i-s');
        Excel::create($nama, function ($excel) use ($request) {
        $excel->sheet('Laporan Data Buku', function ($sheet) use ($request) {
        
        $sheet->mergeCells('A1:L1');

       // $sheet->setAllBorders('thin');
        $sheet->row(1, function ($row) {
            $row->setFontFamily('Calibri');
            $row->setFontSize(11);
            $row->setAlignment('center');
            $row->setFontWeight('bold');
        });

        $sheet->row(1, array('LAPORAN DATA BUKU'));

        $sheet->row(2, function ($row) {
            $row->setFontFamily('Calibri');
            $row->setFontSize(11);
            $row->setFontWeight('bold');
        });

        $datas = Buku::all();

       // $sheet->appendRow(array_keys($datas[0]));
        $sheet->row($sheet->getHighestRow(), function ($row) {
            $row->setFontWeight('bold');
        });

         $datasheet = array();
         $datasheet[0]  =   array("NO", "NO INVENTARIS", "JUDUL", "PENGARANG", "TEMPAT TAHUN TERBIT", "CETAKAN JILID", "KODE", "ASAL", "ISBN", "HARGA",  "UKURAN","JUMLAH BUKU");
         $i=1;

        foreach ($datas as $data) {

           // $sheet->appendrow($data);
          $datasheet[$i] = array($i,
                        $data['no_inventaris'],
                        $data['judul'],
                        $data['pengarang'],
                        $data['tempat_tahun_terbit'],
                        $data['cetakan_jilid'],
                        $data['kode'],
                        $data['asal'],
                        $data['isbn'],
                        $data['harga'],
                        $data['ukuran'],
                        $data['jumlah_buku']
                    );
          
          $i++;
        }

        $sheet->fromArray($datasheet);
    });

})->export('xls');

}


public function transaksi()
    {

        return view('laporan.transaksi');
    }


    public function transaksiPdf(Request $request)
    {
        // $q = Transaksi::query();

        $q = [];
        if($request->get('status')) 
        {
             if($request->get('status') == 'pinjam') {
                $q['status'] = 'pinjam';
            } else {
                $q['status'] = 'kembali';
            }
        }

        if(Auth::user()->level == 'user')
        {
            $q['anggota_id'] = Auth::user()->anggota->id;
        }

        $datas = Transaksi::books($q);

       // return view('laporan.transaksi_pdf', compact('datas'));
       $pdf = PDF::loadView('laporan.transaksi_pdf', compact('datas'));
       return $pdf->download('laporan_transaksi_'.date('Y-m-d_H-i-s').'.pdf');
    }


public function transaksiExcel(Request $request)
    {
        $nama = 'laporan_transaksi_'.date('Y-m-d_H-i-s');
        Excel::create($nama, function ($excel) use ($request) {
        $excel->sheet('Laporan Data Transaksi', function ($sheet) use ($request) {
        
        $sheet->mergeCells('A1:H1');

       // $sheet->setAllBorders('thin');
        $sheet->row(1, function ($row) {
            $row->setFontFamily('Calibri');
            $row->setFontSize(11);
            $row->setAlignment('center');
            $row->setFontWeight('bold');
        });

        $sheet->row(1, array('LAPORAN DATA TRANSAKSI'));

        $sheet->row(2, function ($row) {
            $row->setFontFamily('Calibri');
            $row->setFontSize(11);
            $row->setFontWeight('bold');
        });

        // $q = Transaksi::query();
        $where = [];

        if($request->get('status')) 
        {
             if($request->get('status') == 'pinjam') {
                $where['status'] = 'pinjam';
            } else {
                $where['status'] = 'kembali';
            }
        }


        if(Auth::user()->level == 'user')
        {
            $where['anggota'] = Auth::user()->anggota->id;
            // $q->where('anggota_id', Auth::user()->anggota->id);
        }

        $datas = Transaksi::books($where);
        // $datas = $q->get();

       // $sheet->appendRow(array_keys($datas[0]));
        $sheet->row($sheet->getHighestRow(), function ($row) {
            $row->setFontWeight('bold');
        });

         $datasheet = array();
         $datasheet[]  =   array("NO", "KODE TRANSAKSI", "BUKU", "PEMINJAM",  "TGL PINJAM","TGL KEMBALI","STATUS", "KET");
         $i=1;

        foreach ($datas as $data) {
            $books = $data->buku;
            $totalBooks = count($books);
            // dd($books[0]);
           // $sheet->appendrow($data);
          $datasheet[] = array($i,
                        $data['kode_transaksi'],
                        // $data->buku->judul,
                        $books[0]->judul ?? '',
                        $data->anggota->nama,
                        date('d/m/y', strtotime($data['tgl_pinjam'])),
                        date('d/m/y', strtotime($data['tgl_kembali'])),
                        $data['status'],
                        $data['ket']
                    );


          for($a = 1; $a < $totalBooks; $a++){
            $datasheet[] = ['', '', $books[$a]->judul, '', '', '', '', ''];
          };
          $datasheet[] = ['', ''];

          $i++;

        }

        $sheet->fromArray($datasheet);
    });

})->export('xls');

}


}
