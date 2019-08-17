<div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content" style="background: #fff;">
      <div class="modal-header">
            <div style="display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;">
        <h5 class="modal-title">Cari Buku</h5>
        <input id="search-buku" type="text" class="form-control" placeholder="Masukan kata kunci..." style="width:300px;">
            </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="list-buku">
                <button type="submit">Submit</button>

            
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>ISBN</th>
                            <th>Pengarang</th>
                            <th>Tahun</th>
                            <th>Stok</th>
                            <th>Check</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bukus as $data)
                        <tr class="pilih" 
                            data-buku_id="{{$data->id}}>" 
                            data-buku_judul="{{strtolower($data->judul)}}">
                            <td>
                                @if($data->cover)
                                    <img src="{{url('images/buku/'. $data->cover)}}" alt="image" style="margin-right: 10px;" />
                                @else
                                    <img src="{{url('images/buku/default.png')}}" alt="image" style="margin-right: 10px;" />
                                @endif
                                {{$data->judul}}
                            </td>
                            <td>{{$data->isbn}}</td>
                            <td>{{$data->pengarang}}</td>
                            <td>{{$data->tahun_terbit}}</td>
                            <td>{{$data->jumlah_buku}}</td>
                            <td>
                                <input type="checkbox" name="buku_pinjam[]" value="{{$data->id}}">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>  
                </form>
            </div>
            
        </div>
    </div>
</div>