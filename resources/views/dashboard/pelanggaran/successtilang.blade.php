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
                              
                        </div>
                  </div>
            </div>
            <div class="card-body p-4">
                  <div class="row">
                        <div class="col-md-12"><hr></div>
                        <div class="col-md-12 text-center">
                              <p><strong>{{ $ktp->nama }}</strong> berhasil di tilang</p>
                              <a href="{{ url('dashboard/pelanggaran') }}" class="text-center"> <img src="{{ url('upload/zzSUCCESS.png') }}" alt="Tilang success" width="20%" class="rounded" /></a>
                              <p>Pelanggaran : </p>

                              <table>
                                    @php 
                                          $no = 1;
                                    @endphp
                                    @foreach($pelanggaran_item as $pel)
                                          <p>{{ $no }} | {{ $pel->perkara }} | {{ $pel->pasal }} | <strong>Rp. {{ number_format($pel->denda) }}</strong></p>
                                    @php 
                                          $no++;
                                    @endphp
                                    @endforeach
                              </table>
                        </div>
                  </div>
            </div>
      </div>
@endsection