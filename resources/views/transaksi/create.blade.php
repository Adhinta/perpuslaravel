@section('js')
 <script type="text/javascript">
  $(document).on('click', '.pilih_anggota', function (e) {
      document.getElementById("anggota_id").value = $(this).attr('data-anggota_id');
      document.getElementById("anggota_nama").value = $(this).attr('data-anggota_nama');
      $("#search-anggota").val("");
      $("#myModal2 table tr").show();
      $('#myModal2').modal('hide');
  });
  //  $(document).on('click', '.pilih', function (e) {
  //               document.getElementById("buku_judul").value = $(this).attr('data-buku_judul');
  //               document.getElementById("buku_id").value = $(this).attr('data-buku_id');
  //               $('#myModal').modal('hide');
  //           });

            
          
  //            $(function () {
  //               $("#lookup, #lookup2").dataTable();
  //           });

  
  var Table = {
    $el:$("#list-buku"),
    bukus:{!! json_encode($bukus) !!},
    bukuCart:[],
    renderTercentang:function(e){
      $("#buku-tercentang tbody").empty();

      var bukuCart = this.bukuCart.map((val) => {
        var result;
        this.bukus.forEach((v) => {
          if(val.value == v.id){
            result = v;
          }
        });
        return result;
      });


      bukuCart.forEach((val) => {
        $("#buku-tercentang").append(`<tr>
            <td>${val.id}</td>
            <td>${val.no_inventaris}</td>
            <td>${val.judul}</td>
          </tr>`);
      });
    },
    submitData:function(){
      var serialize = $("#form-transaksi").serializeArray();
      // return;
      serialize = serialize.map((val) => {
        if(val.name == 'buku_id'){
          val.value = this.bukuCart.map((val) => {
            return val.value;
          });
        }
        return val;
      });
      $.ajax({
        url:"{{ route('transaksi.store') }}",
        type:'POST',
        headers:{
          'X-CSRF-TOKEN':"{{ csrf_token() }}"
        },
        data:$.param(serialize)
      }).done((res) => {
        if(res.success == true){
          var c = swal("Success", "", "success");
          if(c){
            location.href = "{{ url("/transaksi") }}";
          }
        }
      }).fail((res) => {
        swal("Masukan data gagal", res.responseJSON.message, "warning");
      });
    },
    submit:function(e){
      if(e != null){
        e.preventDefault();
      }
      
      this.bukuCart = $("form#list-buku").serializeArray();

      $("#myModal").modal("hide");

      this.renderTercentang();
    },
    init(){
      console.log("Init dong...", this.bukus);
      // $(document).ready(() => {
        console.log("my elf : ", this.$el);
        $(".main-panel").on('submit', this.$el, (e) => {
          e.preventDefault();
          this.submit();
        });
        $(".main-panel").on("submit", "#form-transaksi", (e) => {
          e.preventDefault();
          this.submitData();
        // })
      });
    }
  }

  Table.init();

$(document).ready(() => {
  $("#search-anggota").on("keyup", (e) => {
    var q = e.target.value;

    console.log(q);
    $("#myModal2 table tr").show();
    if(q != ""){
      console.log($("#myModal2 table").find(`tr.pilih_anggota:not([data-anggota_nama*='${q.toLowerCase()}'])`).hide());
    }
  })
})
$(document).ready(() => {
  $("#search-buku").on("keyup", (e) => {
    var q = e.target.value;

    console.log(q);
    $("#myModal table tr").show();
    if(q != ""){
      console.log($("#myModal table").find(`tr.pilih:not([data-buku_judul*='${q.toLowerCase()}'])`).hide());
    }
  })
})
</script>

@stop
@section('css')

@stop
@extends('layouts.app')

@section('content')

<form method="POST" id="form-transaksi">
    {{ csrf_field() }}
<div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Tambah Transaksi baru</h4>
                    
                        <div class="form-group{{ $errors->has('kode_transaksi') ? ' has-error' : '' }}">
                            <label for="kode_transaksi" class="col-md-4 control-label">Kode Transaksi</label>
                            <div class="col-md-6">
                                <input id="kode_transaksi" type="text" class="form-control" name="kode_transaksi" value="{{ $kode }}" required readonly="">
                                @if ($errors->has('kode_transaksi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kode_transaksi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group{{ $errors->has('tgl_pinjam') ? ' has-error' : '' }}">
                            <label for="tgl_pinjam" class="col-md-4 control-label">Tanggal Pinjam</label>
                            <div class="col-md-3">
                                <input id="tgl_pinjam" type="date" class="form-control" name="tgl_pinjam" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}" required @if(Auth::user()->level == 'user') readonly @endif>
                                @if ($errors->has('tgl_pinjam'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tgl_pinjam') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group{{ $errors->has('tgl_kembali') ? ' has-error' : '' }}">
                            <label for="tgl_kembali" class="col-md-4 control-label">Tanggal Kembali</label>
                            <div class="col-md-3">
                                <input id="tgl_kembali" type="date"  class="form-control" name="tgl_kembali" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->addDays(5)->toDateString())) }}" required="" @if(Auth::user()->level == 'user') readonly @endif>
                                @if ($errors->has('tgl_kembali'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tgl_kembali') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                         @if(Auth::user()->level == 'admin')
                        <div class="form-group{{ $errors->has('anggota_id') ? ' has-error' : '' }}">
                            <label for="anggota_id" class="col-md-4 control-label">Anggota</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                <input id="anggota_nama" type="text" class="form-control" readonly="" required>
                                <input id="anggota_id" type="hidden" name="anggota_id" value="{{ old('user_id') }}" required readonly="">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-warning btn-secondary" data-toggle="modal" data-target="#myModal2"><b>Cari Anggota</b> <span class="fa fa-search"></span></button>
                                </span>
                                </div>
                                @if ($errors->has('anggota_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('anggota_id') }}</strong>
                                    </span>
                                @endif
                                 
                            </div>
                        </div>
                        @else
                        <div class="form-group{{ $errors->has('anggota_id') ? ' has-error' : '' }}">
                            <label for="anggota_id" class="col-md-4 control-label">Anggota</label>
                            <div class="col-md-6">
                                <input id="anggota_nama" type="text" class="form-control" readonly="" value="{{Auth::user()->anggota->nama}}" required>
                                <input id="anggota_id" type="hidden" name="anggota_id" value="{{ Auth::user()->anggota->id }}" required readonly="">
                              
                                @if ($errors->has('anggota_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('anggota_id') }}</strong>
                                    </span>
                                @endif
                                 
                            </div>
                        </div>
                        @endif

                        <div class="form-group{{ $errors->has('buku_id') ? ' has-error' : '' }}">
                            <label for="buku_id" class="col-md-4 control-label">Buku</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                <input id="buku_judul" type="text" class="form-control" readonly="" required>
                                <input id="buku_id" type="hidden" name="buku_id" value="{{ old('buku_id') }}" required readonly="">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info btn-secondary" data-toggle="modal" data-target="#myModal"><b>Cari Buku</b> <span class="fa fa-search"></span></button>
                                </span>
                                </div>
                                
                                @if ($errors->has('buku_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('buku_id') }}</strong>
                                    </span>
                                @endif
                                 
                            </div>
                        </div>
                        
                        <table border="1" width="600" id="buku-tercentang">
                        <thead>
                          <tr align="center">
                           <th >
                            No
                          </th>
                          <th>
                            Kode
                          </th>
                          <th>
                            Buku
                          </th>
                        </tr>
                        </thead>

                        <tbody>
                          <tr>
                            <td colspan="3">
                              <br/>
                              <p class="text-center">Belum ada buku dipilih</p>
                              <br/>
                            </td>
                          </tr>
                        </tbody>
                        </table>
                        <br>

                       

                        <div class="form-group{{ $errors->has('ket') ? ' has-error' : '' }}">
                            <label for="ket" class="col-md-4 control-label">Keterangan</label>
                            <div class="col-md-6">
                                <input id="ket" type="text" class="form-control" name="ket" value="{{ old('ket') ?? 'Baik' }}">
                                @if ($errors->has('ket'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ket') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" id="submit">
                                    Submit
                        </button>
                        <button type="reset" class="btn btn-danger">
                                    Reset
                        </button>
                        <a href="{{route('transaksi.index')}}" class="btn btn-light pull-right">Back</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

</div>
</form>

  
        @include('transaksi.modal-add-anggota')
        @include('transaksi.modal-add-buku')
@endsection