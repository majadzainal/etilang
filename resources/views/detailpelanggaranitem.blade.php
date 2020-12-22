@extends('layouts.dashboard')


@section('content')

      @if($notif == "deleted")
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Deleted success!</strong> <br>Berhasil menghapus data pasal perkara.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                  </button>
            </div>
      @elseif($notif == "added")
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Added success!</strong> <br>Berhasil menambahkan data pasal perkara.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                  </button>
            </div>
      @elseif($notif == "updated")
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                  <strong>Updated success!</strong> <br>Berhasil merubah data pasal perkara.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                  </button>
            </div>
      @elseif($notif == "pasalmorethenone")
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Pelanggaran tidak di pilih!</strong> <br>Mohon untuk pilih salah satu atau lebih dari pasal yang di langgar.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                  </button>
            </div>
      @elseif($notif == "pilihfoto")
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Foto tidak di pilih!</strong> <br>Mohon untuk upload satu atau lebih dari foto sebagai bukti.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                  </button>
            </div>
      @endif
      <div class="card p-0">
            <div class="card-header">
                  <div class="row">
                        <div class="col-8">
                              <h3>Data Pelanggaran</h3>
                        </div>
                        <div class="col-4 text-right">
                              <a href="{{ url('dashboard') }}"><button class="btn btn-sm text-secondary" data-toggle="modal" data-target="#deleteModal">Kembali</button></a>
                        </div>
                  </div>
            </div>
            <div class="card-body p-4">
                  @php 
                        $no = 1;
                  @endphp
                  @foreach($pelanggaran_item as $pel)

                  <div class="form-group row">
                        <label for="Perkara" class="col-sm-2 col-form-label">Perkara {{ $no }}</label>
                        <div class="col-sm-10">
                              <div class="form-perkara">
                                    <p for="perkara" class="col-form-label"><strong>Tanggal pelanggaran : {{ $pel->created_at }}</strong></p>
                                    <label for="perkara" class="col-form-label">Perkara</label>
                                    <input type="text" disabled="disabled" class="form-control" id="perkara" value="{{ $pel->perkara }}">

                                    <label for="pasal" class="col-form-label">Pasal</label>
                                    <input type="text" disabled="disabled" class="form-control" id="pasal" value="{{ $pel->pasal }}">

                                    <label for="denda" class="col-form-label">Denda</label>
                                    <input type="text" disabled="disabled" class="form-control" id="pasal" value="Rp. {{ number_format($pel->denda) }}">
                              </div>
                        </div>
                        <div class="col-sm-10">
                              
                        </div>
                  </div>

                  @php 
                  $no++;
                  @endphp
                  @endforeach

                  <button class="btn btn-primary btn-block" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2}">Lihat Foto</button>
                  <hr>

                  <div class="row">
                        @foreach($fotos as $foto)
                        <div class="col-md-3">
                              <div class="collapse multi-collapse" id="multiCollapseExample1">
                                    <div class="card card-body">
                                          <img src="{{ url('upload/'.$foto->name) }}" alt="Tilang success" width="100%" class="rounded">
                                    </div>
                              </div>
                        </div>
                        @endforeach
                        </div>
                  </div>

                  <hr>
                  <br>
                  <br>
            </div>
      </div>
@endsection