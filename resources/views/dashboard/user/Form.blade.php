@extends('layouts.dashboard')


@section('content')
      <div class="card p-0">
            <div class="card-header">
                  <div class="row">
                        <div class="col-8">
                              <h3>Users</h3>
                        </div>
                        <div class="col-4 text-right">
                              <button class="btn btn-sm text-secondary" data-toggle="modal" data-target="#deleteModal">Delete</button>
                        </div>
                  </div>
            </div>
            <div class="card-body p-4">
                  <div class="row">
                        <div class="col-md-12">
                              <form class="row" method="post" action="{{ url('dashboard/user/update/'. $user->id . '/'. $petugas->id) }}">
                                    @csrf
                                    @method('put')
                                    <div class="form-group col-6">
                                          <label for="name">Username</label>
                                          <input type="text" class="form-control" name="username" value="{{ old('username') ?? $user->username }}">
                                          @error('username')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div>

                                    <div class="form-group col-6">
                                          <label for="name">Email</label>
                                          <input type="text" class="form-control" name="email" value="{{ old('email') ?? $user->email }}">
                                          @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div>             

                                    <div class="form-group col-6">
                                          <label for="nik">NIK</label>
                                          <input type="text" class="form-control" name="nik" value="{{ old('nik') ?? $petugas->nik }}">
                                          @error('nik')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div> 

                                    <div class="form-group col-6">
                                          <label for="tempat_lahir">Tempat Lahir</label>
                                          <input type="text" class="form-control" name="tempat_lahir" value="{{ old('tempat_lahir') ?? $petugas->tempat_lahir }}">
                                          @error('tempat_lahir')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div> 

                                    <div class="form-group col-6">
                                          <label for="tanggal_lahir">Tanggal Lahir</label>
                                          <input type="text" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir') ?? $petugas->tanggal_lahir }}" placeholder="yyyy-mm-dd">
                                          @error('tanggal_lahir')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div> 

                                    <div class="form-group col-6">
                                          <label for="jenis_kelamin">Jenis Kelamin</label>
                                          <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                                                @foreach($jenis_kelamin as $kelamin)

                                                      <option value="{{ $kelamin['jenis_kelamin'] }}"
                                                      {{ $petugas->jenis_kelamin == $kelamin['jenis_kelamin'] ? 'selected' : ''}}
                                                      >{{ $kelamin['jenis_kelamin'] }}</option>

                                                @endforeach
                                          </select>
                                          @error('jenis_kelamin')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div> 

                                    <div class="form-group col-6">
                                          <label for="alamat">Alamat</label>
                                          <input type="text" class="form-control" name="alamat" value="{{ old('alamat') ?? $petugas->alamat }}">
                                          @error('alamat')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div> 

                                    <div class="form-group col-6">
                                          <label for="agama">Agama</label>
                                          <input type="text" class="form-control" name="agama" value="{{ old('agama') ?? $petugas->agama }}">
                                          @error('agama')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div> 

                                    <div class="form-group col-6">
                                          <label for="status_perkawinan">Status Perkawinan</label>
                                          <select name="status_perkawinan" class="form-control" id="status_perkawinan">
                                                @foreach($status_perkawinan as $perkawinan)

                                                      <option value="{{ $perkawinan['status_perkawinan'] }}"
                                                      {{ $petugas->status_perkawinan == $perkawinan['status_perkawinan'] ? 'selected' : ''}}
                                                      >{{ $perkawinan['status_perkawinan'] }}</option>

                                                @endforeach
                                          </select>
                                          @error('status_perkawinan')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div> 

                                    <div class="form-group col-12 row p-4">
                                          <button type="submit" class="btn btn-success btn-md  btn-block col-6">Update</button>
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
                              <p>Anda yakin ingin hapus user {{ $user->username }}</p>
                        </div>

                        <div class="modal-footer">
                              <form method="post" action="{{ url('dashboard/user/delete/'. $user->id) }}">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                              </form>
                        </div>
                  </div>
            </div>
      </div>
@endsection