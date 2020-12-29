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
                        <div class="col-md btn-secondary m-1">
                              3. Upload foto pelanggaran >>
                        </div>
                        <div class="col-md btn-secondary m-1">
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
                  <div class="row">
                        <div class="col-md-12">
                              <label for="nik" class="col-md-2">NIK</label>
                              <input type="text" class="col-md-5" name="nik" value="{{ $ktp->nik }}" disabled="disabled">
                        </div>
                        <div class="col-md-12">
                              <label for="nama" class="col-md-2">Nama</label>
                              <input type="text" class="col-md-5" name="nama" value="{{ $ktp->nama }}" disabled="disabled">
                        </div>
                        <div class="col-md-12">
                              <label for="tempat_lahir" class="col-md-2">Tempat / Tgl. Lahir</label>
                              <input type="text" class="col-md-5" name="tempat_lahir" value="{{ $ktp->tempat_lahir.' / '.$ktp->tanggal_lahir  }}" disabled="disabled">
                        </div>
                        <div class="col-md-12">
                              <label for="alamat" class="col-md-2">Alamat</label>
                              <input type="text" class="col-md-5" name="alamat" value="{{ $ktp->alamat }}" disabled="disabled">
                        </div>
                        <div class="col-md-12">
                              <label for="email" class="col-md-2">Email</label>
                              <input type="text" class="col-md-5" name="email" value="{{ $ktp->email }}" disabled="disabled">
                        </div>
                  </div>
                  <div class="row">
                  <form method="post" class="row p-4" action="{{ url('dashboard/pelanggaran/store') }}">
                                    @csrf
                                    @method('post')
                              <div class="col-md-12">
                                    <hr>
                                    <h3>Daftar Pelanggaran</h3>
                                    <hr>

                                    <input type="text" name="nik" hidden="hidden" value="{{ $ktp->nik }}" />

                                    @error('pasal[]')
                                          <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @foreach($pasals as $pas)
                                          <div class="form-group col-12">
                                                <input type="checkbox" name="pasal[]" class="form-check-input" value="{{ $pas->id }}" id="{{ $pas->id }}">
                                                <label class="form-check-label" for="{{ $pas->id }}">{{ $pas->perkara }} (Denda Rp. {{ number_format($pas->denda) }})</label>
                                          </div>
                                    
                                    @endforeach 
                              </div>

                              <div class="row col-md-12">
                                    <div class="container">
                                          <hr>
                                          <div class="row">
                                                <div class="form-group col-6">
                                                      <button type="submit" class="btn btn-primary btn-md  btn-block">Simpan</button>
                                                </div>
                                                <div class="form-group col-6">
                                                      <a href="{{ url('dashboard/pelanggaran') }}">
                                                      <button type="button" class="btn btn-danger btn-md  btn-block">Batal</button></a>
                                                </div>
                                          </div>
                                          <hr>
                                    </div>
                                    
                              </div>
                  </form>
                  </div>
                  <h3 class="p-5">Daftar Pelanggaran</h3>
                  <div class="rightScrol">
                        <table class="table table-borderless table-striped table-hover">
                              <thead>
                                    <tr>
                                          <th>#</th>
                                          <th>NIK</th>
                                          <th>Denda</th>
                                          <th>Tanggal Pelanggaran</th>
                                    </tr>
                              </thead>
                              <tbody>
                                    @foreach($pelanggarans as $pel)
                                    <tr>
                                          <td>#</td>
                                          <td>{{ $pel->nik }}</td>
                                          <td>Rp. {{ number_format($pel->denda) }}</td>
                                          <td>{{ $pas->created_at }}</td>
                                    </tr>
                                    @endforeach
                              </tbody>
                        </table>
                  </div>
            </div>
      </div>
@endsection