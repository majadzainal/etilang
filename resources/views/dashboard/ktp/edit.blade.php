@extends('layouts.dashboard')


@section('content')
      <div class="card p-0">
            <div class="card-header">
                  <div class="row">
                        <div class="col-8">
                              <h3>Kartu Tanda Penduduk</h3>
                        </div>
                        <div class="col-4 text-right">
                              <button class="btn btn-sm text-secondary" data-toggle="modal" data-target="#deleteModal">Delete</button>
                        </div>
                  </div>
            </div>
            <div class="card-body p-4">
                  <div class="row">
                        <div class="col-md-12">
                              <form class="row" method="post" action="{{ url('dashboard/ktp/update/'. $ktp->id ) }}">
                                    @csrf
                                    @method('put')
                                    <div class="form-group col-6">
                                          <label for="name">Nama</label>
                                          <input type="text" class="form-control" name="nama" value="{{ old('nama') ?? $ktp->nama }}">
                                          @error('nama')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div>             

                                    <div class="form-group col-6">
                                          <label for="nik">NIK</label>
                                          <input type="text" class="form-control" name="nik" value="{{ old('nik') ?? $ktp->nik }}">
                                          @error('nik')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div> 

                                    <div class="form-group col-6">
                                          <label for="tempat_lahir">Tempat Lahir</label>
                                          <input type="text" class="form-control" name="tempat_lahir" value="{{ old('tempat_lahir') ?? $ktp->tempat_lahir }}">
                                          @error('tempat_lahir')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div> 

                                    <div class="form-group col-6">
                                          <label for="tanggal_lahir">Tanggal Lahir</label>
                                          <input type="text" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir') ?? $ktp->tanggal_lahir }}" placeholder="yyyy-mm-dd">
                                          @error('tanggal_lahir')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div> 

                                    <div class="form-group col-6">
                                          <label for="jenis_kelamin">Jenis Kelamin</label>
                                          <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                                                @foreach($jenis_kelamin as $kelamin)

                                                      <option value="{{ $kelamin['jenis_kelamin'] }}">{{ $kelamin['jenis_kelamin'] }}</option>

                                                @endforeach
                                          </select>
                                          @error('jenis_kelamin')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div> 

                                    <div class="form-group col-6">
                                          <label for="alamat">Alamat</label>
                                          <input type="text" class="form-control" name="alamat" value="{{ old('alamat') ?? $ktp->alamat }}">
                                          @error('alamat')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div> 

                                    <div class="form-group col-6">
                                          <label for="agama">Agama</label>
                                          <input type="text" class="form-control" name="agama" value="{{ old('agama') ?? $ktp->agama }}">
                                          @error('agama')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div> 

                                    <div class="form-group col-6">
                                          <label for="status_perkawinan">Status Perkawinan</label>
                                          <select name="status_perkawinan" class="form-control" id="status_perkawinan">
                                                @foreach($status_perkawinan as $perkawinan)

                                                      <option value="{{ $perkawinan['status_perkawinan'] }}">{{ $perkawinan['status_perkawinan'] }}</option>

                                                @endforeach
                                          </select>
                                          @error('status_perkawinan')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div> 

                                    <div class="form-group col-6">
                                          <label for="pekerjaan">Pekerjaan</label>
                                          <input type="text" class="form-control" name="pekerjaan" value="{{ old('pekerjaan') ?? $ktp->pekerjaan }}">
                                          @error('pekerjaan')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div>

                                    <div class="form-group col-6">
                                          <label for="kewarganegaraan">Kewarganegaraan</label>
                                          <input type="text" class="form-control" name="kewarganegaraan" value="{{ old('kewarganegaraan') ?? $ktp->kewarganegaraan }}">
                                          @error('kewarganegaraan')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div>

                                    <div class="form-group col-6">
                                          <label for="email">Email</label>
                                          <input type="text" class="form-control" name="email" value="{{ old('email') ?? $ktp->email }}">
                                          @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div>

                                    <div class="col-12">
                                          <hr>
                                          <div class="row">
                                                <div class="form-group col-6">
                                                      <button type="submit" class="btn btn-primary btn-md  btn-block">Simpan</button>
                                                </div>
                                                <div class="form-group col-6">
                                                      <a href="{{ url('dashboard/ktp/')}}">
                                                      <button type="button" class="btn btn-danger btn-md  btn-block">Batal</button></a>
                                                </div>
                                          </div>
                                          <hr>
                                    </div>
                                   
                              </form>
                        </div>
                  </div>
            </div>
      </div>
      <div class="modal fade" id="deleteModal">
            <div class="modal-dialog">
                  <div class="modal-content">
                        <div class="modal-header">
                              <h5>Delete</h5>
                        </div>

                        <div class="modal-body">
                              <p>Anda yakin ingin hapus ktp {{ $ktp->nama }} ({{ $ktp->nik }}) </p>
                        </div>

                        <div class="modal-footer">
                              <form method="post" action="{{ url('dashboard/ktp/delete/'. $ktp->id) }}">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                              </form>
                        </div>
                  </div>
            </div>
      </div>
@endsection