<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content" style="background: #fff;">
        <div class="modal-header">
        <div style="display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;">
          <h5 class="modal-title" id="exampleModalLabel" style="width:400px;">Cari Anggota</h5>
          <input id="search-anggota" type="text" class="form-control" placeholder="Masukan kata kunci..." style="width:300px;">
        </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
                          <table id="lookup" class="table table-bordered table-hover table-striped">
                              <thead>
                          <tr>
                            <th>
                              Nama
                            </th>
                            <th>
                              NPM
                            </th>
                            <th>
                              Prodi
                            </th>
                            <th>
                              Jenis Kelamin
                            </th>
                          </tr>
                        </thead>
                              <tbody>
                                  @foreach($anggotas as $data)
                                  <tr class="pilih_anggota" data-anggota_id="<?php echo $data->id; ?>" data-anggota_nama="<?php echo strtolower($data->nama); ?>" >
                                      <td class="py-1">
                            @if($data->user->gambar)
                              <img src="{{url('images/user', $data->user->gambar)}}" alt="image" style="margin-right: 10px;" />
                            @else
                              <img src="{{url('images/user/default.png')}}" alt="image" style="margin-right: 10px;" />
                            @endif
  
                              {{$data->nama}}
                            </td>
                            <td>
                              {{$data->npm}}
                            </td>
  
                            <td>
                            @if($data->prodi == 'TI')
                              Teknik Informatika
                            @elseif($data->prodi == 'SI')
                              Sistem Informasi
                            @else
                              Kesehatan Masyarakat
                            @endif
                            </td>
                            <td>
                              {{$data->jk === "L" ? "Laki - Laki" : "Perempuan"}}
                            </td>
                          </tr>
                                  @endforeach
                              </tbody>
                          </table>  
                      </div>
                  </div>
              </div>
          </div>