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
            <div class="card-body">
                  <div class="row">
                        <div class="col-md btn-success m-1">
                              1. Cari NIK >>
                        </div>
                        <div class="col-md btn-success m-1">
                              2. Pilih pelanggaran >>
                        </div>
                        <div class="col-md btn-success m-1">
                              3. Upload foto pelanggaran >>
                        </div>
                        <div class="col-md btn-success m-1">
                              4. Selesai input pelanggaran >>
                        </div>
                  </div>
            </div>
      </div>
      <div class="card p-0">
            <div class="card-header">
                  <div class="row">
                        <div class="col-8">
                              <h3>Data Pelanggaran</h3>
                        </div>
                        <div class="col-4 text-right">
                              <a href="{{ url('dashboard/pelanggaran') }}"><button class="btn btn-sm text-secondary" data-toggle="modal" data-target="#deleteModal">Batal</button></a>
                        </div>
                  </div>
            </div>
            <div class="card-body p-4">
            <form method="POST" 
                  enctype="multipart/form-data"
                  action="{{ url('dashboard/pelanggaran/finishpelanggaranstore')}}">
                  @csrf
                  @method('post')
                  <input type="text" name="pelanggaran_id" hidden="hidden" value="{{ $pelanggaran_id }}">
                        <div class="row">
                              <div class="col-md-12"><hr></div>
                              <div class="col-md-12 form-group">
                                    <button type="submit" class="form-control btn-primary btn-lg"><h3>FINISH</h3></button>
                              </div>
                              <!-- <div class="col-md">
                              <button type="button" class="form-control btn-danger">batal</button>
                              </div> -->
                              
                             
                        </div>
                  </form>
                  <h3 class="p-5">Daftar Pelanggaran</h3>
                  <div class="rightScrol">
                        <table class="table table-borderless table-striped table-hover">
                              <thead>
                                    <tr>
                                          <th>#</th>
                                          <th>NIK</th>
                                          <th>Total Denda</th>
                                          <th>Tanggal Pelanggaran</th>
                                    </tr>
                              </thead>
                              <tbody>
                                    @foreach($pelanggaran as $pel)
                                    <tr>
                                          <td>#</td>
                                          <td>{{ $pel->nik }}</td>
                                          <td>Rp. {{ number_format($pel->denda) }}</td>
                                          <td>{{ $pel->created_at }}</td>
                                    </tr>
                                    @endforeach
                              </tbody>
                        </table>
                  </div>
            </div>
      </div>
@endsection