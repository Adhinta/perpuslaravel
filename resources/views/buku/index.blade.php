@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable({
      "iDisplayLength": 50
    });

} );
</script>
@stop
@extends('layouts.app')

@section('content')
<div class="row">

  <div class="col-lg-2">
    <a href="{{ route('buku.create') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Tambah Buku</a>
  </div>

    <div class="col-lg-12">
                  @if (Session::has('message'))
                  <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">{{ Session::get('message') }}</div>
                  @endif
                  </div>
</div>
<div class="row" style="margin-top: 20px;">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">

                <div class="card-body">
                  <h4 class="card-title pull-left">Data Buku</h4>
                  <div class="table-responsive">
                    <table class="table table-striped" id="table">
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
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($datas as $data)
                        <tr>
                          <td>
                          
                            {{$data->no_inventaris}}
                          
                          </td>
                          <td class="py-1">
                          <a href="{{route('buku.show', $data->id)}}"> 
                            {{$data->judul}}
                          </a>
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
                          
                          <td>
                          <div class="btn-group dropdown">
                          <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </button>
                          <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                            <a class="dropdown-item" href="{{route('buku.edit', $data->id)}}"> Edit </a>
                            <form action="{{ route('buku.destroy', $data->id) }}" class="pull-left"  method="post">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button class="dropdown-item" onclick="return confirm('Anda yakin ingin menghapus data ini?')"> Delete
                            </button>
                          </form>
                           
                          </div>
                        </div>
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
               {{--  {!! $datas->links() !!} --}}
                </div>
              </div>
            </div>
          </div>
@endsection