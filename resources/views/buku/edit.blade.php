@section('js')

<script type="text/javascript">

$(document).ready(function() {
    $(".users").select2();
});

</script>

<script type="text/javascript">
        function readURL() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).prev().attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function () {
            $(".uploads").change(readURL)
            $("#f").submit(function(){
                // do ajax submit or just classic form submit
              //  alert("fake subminting")
                return false
            })
        })
        </script>
@stop

@extends('layouts.app')

@section('content')

<form action="{{ route('buku.update', $data->id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('put') }}
<div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Edit Buku <b>{{$data->judul}}</b> </h4>
                      <br>
                      <form class="forms-sample">

                      <div class="form-group{{ $errors->has('no_inventaris') ? ' has-error' : '' }}">
                            <label for="no_inventaris" class="col-md-4 control-label">No Inventaris</label>
                            <div class="col-md-6">
                                <input id="no_inventaris" type="number" class="form-control" name="no_inventaris" value="{{  $data->no_inventaris }}" required>
                                @if ($errors->has('no_inventaris'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('no_inventaris') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      
                        <div class="form-group{{ $errors->has('judul') ? ' has-error' : '' }}">
                            <label for="judul" class="col-md-4 control-label">Judul</label>
                            <div class="col-md-6">
                                <input id="judul" type="text" class="form-control" name="judul" value="{{ $data->judul }}" required>
                                @if ($errors->has('judul'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('judul') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('pengarang') ? ' has-error' : '' }}">
                            <label for="pengarang" class="col-md-4 control-label">Pengarang</label>
                            <div class="col-md-6">
                                <input id="pengarang" type="text" class="form-control" name="pengarang" value="{{  $data->pengarang }}" required>
                                @if ($errors->has('pengarang'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pengarang') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tempat_tahun_terbit') ? ' has-error' : '' }}">
                            <label for="tempat_tahun_terbit" class="col-md-4 control-label">Tempat Tahun Terbit</label>
                            <div class="col-md-6">
                                <input id="tempat_tahun_terbit" type="text" class="form-control" name="tempat_tahun_terbit" value="{{ $data->tempat_tahun_terbit }}" required>
                                @if ($errors->has('tempat_tahun_terbit'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tempat_tahun_terbit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('cetakan_jilid') ? ' has-error' : '' }}">
                            <label for="cetakan_jilid" class="col-md-4 control-label">Cetakan Jilid</label>
                            <div class="col-md-6">
                                <input id="cetakan_jilid" type="text" class="form-control" name="cetakan_jilid" value="{{  $data->cetakan_jilid }}" required>
                                @if ($errors->has('cetakan_jilid'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cetakan_jilid') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('kode') ? ' has-error' : '' }}">
                            <label for="kode" class="col-md-4 control-label">Kode</label>
                            <div class="col-md-6">
                                <input id="kode" type="text" class="form-control" name="kode" value="{{ $data->kode }}" required>
                                @if ($errors->has('kode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('asal') ? ' has-error' : '' }}">
                            <label for="asal" class="col-md-4 control-label">Asal</label>
                            <div class="col-md-6">
                                <input id="asal" type="text" class="form-control" name="asal" value="{{ $data->asal }}" required>
                                @if ($errors->has('asal'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('asal') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('npm') ? ' has-error' : '' }}">
                            <label for="isbn" class="col-md-4 control-label">ISBN</label>
                            <div class="col-md-6">
                                <input id="isbn" type="text" class="form-control" name="isbn" value="{{ $data->isbn }}" required>
                                @if ($errors->has('isbn'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('isbn') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('harga') ? ' has-error' : '' }}">
                            <label for="harga" class="col-md-4 control-label">Harga</label>
                            <div class="col-md-6">
                                <input id="harga" type="text" class="form-control" name="harga" value="{{ $data->harga }}" required>
                                @if ($errors->has('harga'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('harga') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ukuran') ? ' has-error' : '' }}">
                            <label for="ukuran" class="col-md-4 control-label">Ukuran</label>
                            <div class="col-md-6">
                                <input id="ukuran" type="text" class="form-control" name="ukuran" value="{{ $data->ukuran }}" required>
                                @if ($errors->has('ukuran'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ukuran') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('jumlah_buku') ? ' has-error' : '' }}">
                            <label for="jumlah_buku" class="col-md-4 control-label">Jumlah Buku</label>
                            <div class="col-md-6">
                                <input id="jumlah_buku" type="number" class="form-control" name="jumlah_buku" value="{{  $data->jumlah_buku }}" required>
                                @if ($errors->has('jumlah_buku'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jumlah_buku') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" id="submit">
                                    Update
                        </button>
                        <a href="{{route('buku.index')}}" class="btn btn-light pull-right">Back</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

</div>
</form>
@endsection