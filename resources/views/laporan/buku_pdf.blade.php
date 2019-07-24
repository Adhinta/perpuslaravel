<!DOCTYPE html>
<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<style type="text/css">
		    table {
    border-spacing: 0;
    width: 100%;
    }
    th {
    background: #404853;
    background: linear-gradient(#687587, #404853);
    border-left: 1px solid rgba(0, 0, 0, 0.2);
    border-right: 1px solid rgba(255, 255, 255, 0.1);
    color: #fff;
    padding: 3px;
    text-align: left;
    text-transform: uppercase;
    }
    th:first-child {
    border-top-left-radius: 4px;
    border-left: 0;
    }
    th:last-child {
    border-top-right-radius: 4px;
    border-right: 0;
    }
    td {
    border-right: 1px solid #c6c9cc;
    border-bottom: 1px solid #c6c9cc;
    padding: 0px;
    }
    td:first-child {
    border-left: 1px solid #c6c9cc;
    }
    tr:first-child td {
    border-top: 0;
    }
    tr:nth-child(even) td {
    background: #e8eae9;
    }
    tr:last-child td:first-child {
    border-bottom-left-radius: 4px;
    }
    tr:last-child td:last-child {
    border-bottom-right-radius: 4px;
    }
    img {
    	width: 40px;
    	height: 40px;
    	border-radius: 100%;
    }
    .center {
    	text-align: center;
    }
	</style>
  <link rel="stylesheet" href="">
	<title>Laporan Data Buku</title>
</head>
<body>
<h1 class="center">LAPORAN DATA BUKU</h1>
 <table id="pseudo-demo">
                      <thead>
                        <tr>
                          <th>
                            No Inventaris
                          </th>
                          <th>
                            Judul
                          </th>
                          <th>
                            Pengarang
                          </th>
                          <th>
                            Tempat Tahun Terbit
                          </th>
                          <th>
                            Cetakan Jilid
                          </th>
                          <th>
                            Kode
                          </th>
                          <th>
                            Asal
                          </th>
                          <th>
                            ISBN
                          </th>
                          <th>
                            Harga
                          </th>
                          <th>
                            Ukuran
                          </th>
                          <th>
                            Jumlah Buku
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($datas as $data)
                        <tr>
                          <td class="py-1">
                            {{$data->no_inventaris}}
                          </td>
                          <td>
                            {{$data->judul}}
                          </td>
                          <td>
                            {{$data->pengarang}}
                          </td>
                          <td>
                            {{$data->tempat_tahun_terbit}}
                          </td>
                          <td>
                            {{$data->cetakan_jilid}}
                          </td>
                          <td>
                            {{$data->kode}}
                          </td>
                          <td>
                            {{$data->asal}}
                          </td>
                          <td>
                          
                            {{$data->isbn}}
                          
                          </td>

                          <td>
                            {{$data->harga}}
                          </td>
                          <td>
                            {{$data->ukuran}}
                          </td>
                          <td>
                            {{$data->jumlah_buku}}
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
</body>
</html>