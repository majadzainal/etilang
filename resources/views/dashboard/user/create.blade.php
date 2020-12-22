@extends('layouts.dashboard')


@section('content')
      <div class="card p-0">
            <div class="card-header">
                  <div class="row">
                        <div class="col-8">
                              <h3>Users</h3>
                        </div>
                        <div class="col-4 text-right">
                              <a href="{{ url('dashboard/users') }}"><button class="btn btn-sm text-secondary">Batal</button></a>
                        </div>
                  </div>
            </div>
            <div class="card-body p-4">
                  <div class="row">
                        <div class="col-md-12">
                              <form class="row" method="post" action="{{ url('dashboard/users/store/') }}">
                                    @csrf
                                    @method('post')
                                    <div class="form-group col-6">
                                          <label for="name">Username</label>
                                          <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                                          @error('username')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div>

                                    <div class="form-group col-6">
                                          <label for="name">Email</label>
                                          <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                                          @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div>             

                                    <div class="form-group col-6">
                                          <label for="nik">NIK</label>
                                          <input type="text" class="form-control" name="nik" value="{{ old('nik') }}">
                                          @error('nik')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div> 

                                    <div class="form-group col-6">
                                          <label for="tempat_lahir">Tempat Lahir</label>
                                          <input type="text" class="form-control" name="tempat_lahir" value="{{ old('tempat_lahir') }}">
                                          @error('tempat_lahir')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div> 

                                    <div class="form-group col-6">
                                          <label for="tanggal_lahir">Tanggal Lahir</label>
                                          <input type="text" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" placeholder="yyyy-mm-dd">
                                          @error('tanggal_lahir')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div> 

                                    <div class="form-group col-6">
                                          <label for="jenis_kelamin">Jenis Kelamin</label>
                                          <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                                                @foreach($jenis_kelamin as $kelamin)

                                                      <option value="{{ $kelamin['jenis_kelamin'] }}"
                                                      {{ old('jenis_kelamin') == $kelamin['jenis_kelamin'] ? 'selected' : ''}}
                                                      >{{ $kelamin['jenis_kelamin'] }}</option>

                                                @endforeach
                                          </select>
                                          @error('jenis_kelamin')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div> 

                                    <div class="form-group col-6">
                                          <label for="alamat">Alamat</label>
                                          <input type="text" class="form-control" name="alamat" value="{{ old('alamat') }}">
                                          @error('alamat')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div> 

                                    <div class="form-group col-6">
                                          <label for="agama">Agama</label>
                                          <input type="text" class="form-control" name="agama" value="{{ old('agama') }}">
                                          @error('agama')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div> 

                                    <div class="form-group col-6">
                                          <label for="status_perkawinan">Status Perkawinan</label>
                                          <select name="status_perkawinan" class="form-control" id="status_perkawinan">
                                                @foreach($status_perkawinan as $perkawinan)

                                                      <option value="{{ $perkawinan['status_perkawinan'] }}"
                                                      {{ old('status_perkawinan') == $perkawinan['status_perkawinan'] ? 'selected' : ''}}
                                                      >{{ $perkawinan['status_perkawinan'] }}</option>

                                                @endforeach
                                          </select>
                                          @error('status_perkawinan')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div> 
                                    <div class="form-group col-6">
                                          <label for="user_level">User Level</label>
                                          <select name="user_level" class="form-control" id="user_level">
                                                @foreach($levels as $lev)

                                                      <option value="{{ $lev['user_level'] }}">{{ $lev['user_level'] }}</option>

                                                @endforeach
                                          </select>
                                                
                                                @error('user_level')
                                                      <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                      </span>
                                                @enderror
                                    </diV>


                                    <div class="form-group col-6">
                                          <label for="password">Password</label>
                                          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                          @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                          @enderror
                                    </div> 
                                    <div class="form-group col-6"></diV>


                                    <div class="form-group col-6">
                                          <label for="password-confirm">Re-Type Password</label>
                                          <input id="password-confirm" type="password" class="form-control" name="password-confirm" required autocomplete="new-password">

                                          @error('password-confirm')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                          @enderror
                                    </div> 
                                    <div class="form-group col-6"></diV>

                                    <button type="submit" class="btn btn-primary btn-lg btn-block m-3">Simpan</button>

                                    
                              </form>
                        </div>
                  </div>
            </div>
      </div>
@endsection