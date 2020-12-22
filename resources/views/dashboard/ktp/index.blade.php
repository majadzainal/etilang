@extends('layouts.dashboard')


@section('content')
      <div class="card p-0">
            <div class="card-header">
                  <div class="row">
                        <div class="col-6">
                              <h3>Data Kartu Tanda Penduduk (KTP)</h3>
                        </div>
                        <div class="col-6">
                              <form method="get" action="{{ url('dashboard/ktp') }}">
                                    <div class="input-group">
                                          <input type="text" class="form-control" name="q" value="{{ $request['q'] ?? '' }}">
                                          <div class="input-group-append">
                                                <button type="submit" class="btn btn-secondary btn-sm">Search</button>
                                          </div>
                                          <div class="input-group-append">
                                                <a href="{{ url('dashboard/ktp/create') }}"><button type="button" class="btn btn-primary btn-sm">Add Kartu Tanda Penduduk</button></a>
                                          </div>
                                    </div>
                              </form>
                        </div>
                  </div>
            </div>
            <div class="card-body p-0">
                  </div>
                  <table class="table table-borderless table-striped table-hover">
                        <thead>
                              <tr>
                                    <th>#</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Email</th>
                                    <th>Registered</th>
                                    <th>Edited</th>
                                    <th>Action</th>
                              </tr>
                        </thead>
                        <tbody>
                              @foreach($ktps as $ktp)
                              <tr>
                                    <td>{{ ($ktps->currentPage() - 1) * ($ktps->perPage()) + $loop->iteration }}</td>
                                    <td>{{ $ktp->nik }}</td>
                                    <td>{{ $ktp->nama }}</td>
                                    <td>{{ $ktp->jenis_kelamin }}</td>
                                    <td>{{ $ktp->email }}</td>
                                    <td>{{ $ktp->created_at }}</td>
                                    <td>{{ $ktp->updated_at }}</td>
                                    <td><a href="{{ url('dashboard/ktp/edit/'.$ktp->id) }}" class="btn btn-success btn-sm">Edit</a></td>
                              </tr>
                              @endforeach
                        </tbody>
                  </table>
                 
            </div>
            {{ $ktps->appends($request)->links() }}
      </div>
@endsection