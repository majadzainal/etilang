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
      @elseif($notif == "notfound")
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>NIK tidak ditemukan!</strong> <br>Nik <strong>{{ $nik }}</strong> tidak berhasil di termukan.
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
                        <div class="col-md btn-secondary m-1">
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
                              
                        </div>
                  </div>
            </div>
            <div class="card-body p-4">
                  <div class="row">
                        <div class="container">
                              <div class="form-group col-md-8">
                                    <form method="post" name="formSearc" action="{{ url('dashboard/pelanggaran/caripelanggaran') }}">
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
            </div>
      </div>
@endsection