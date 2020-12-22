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
                        <div class="container">
                              <div class="form-group col-md-8">
                                    <form method="post" name="formSearc" action="{{ url('dashboard/pelanggaran/caripelanggaranarchive') }}">
                                          @csrf
                                          @method('post')
                                          <label for="nik">NIK</label>
                                          <div class="input-group">
                                          
                                                      <input type="text" class="form-control" name="nik" value="{{ old('nik') ?? $nik }}"/>
                                                      <div class="input-group-append">
                                                            <button type="submit" name="btnSraech" class="btn btn-secondary btn-sm">Search</button>
                                                      </div>
                                          </div>
                                          @error('nama')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </form>
                              </div>             
                        </div>
                  </div>
                <h3 class="p-5">Daftar Pelanggaran</h3>
                <table class="table table-borderless table-striped table-hover">
                    <thead>
                            <tr>
                                <th>#</th>
                                <th>NIK</th>
                                <th>Petugas</th>
                                <th>Status</th>
                                <th>Tilang</th>
                                <th>Tanggal Pelanggaran</th>
                                <th>Detail</th>
                            </tr>
                    </thead>
                    <tbody>
                            @foreach($pelanggaran as $pel)

                            @if($pel->status == 'finish' ||  $pel->paid == 'tilang')
                              <tr>
                                    <td>#</td>
                                    <td>{{ $pel->nik }}</td>
                                    <td>{{ $pel->name }}</td>
                                    <td>{{ $pel->status == 'finish' ? 'Peringatan' : '-' }} </td>
                                    <td>{{ $pel->paid == 'tilang' ? 'Penilangan' : '-' }} </td>
                                    <td>{{ $pel->created_at }}</td>
                                    <td><a href="{{ url('dashboard/pelanggaran/detailpelanggaranitem/'.$pel->id) }}" target="_Blank" class="btn btn-primary btn-sm">DETAIL</a></td>
                              </tr>
                            @endif
                            @endforeach
                    </tbody>
                </table>
            </div>
      </div>
@endsection