@extends('layouts.dashboard')


@section('content')
      @if($notif == "deletedsuccess")
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Deleted success!</strong> <br>Berhasil menghapus user.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                  </button>
            </div>
      @elseif($notif == "addedsuccess")
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Added success!</strong> <br>Berhasil menambahkan user.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                  </button>
            </div>
      @elseif($notif == "updatedsuccess")
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                  <strong>Updated success!</strong> <br>Berhasil merubah user.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                  </button>
            </div>
      @elseif($notif == "deletedfailed")
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Updated Faill!</strong> <br>Gagal Menghapus user.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                  </button>
            </div>
      @endif
      <div class="card p-0">
            <div class="card-header">
                  <div class="row">
                        <div class="col-8">
                              <h3>Users</h3>
                        </div> 
                        <div class="col-4">
                              <form method="get" action="{{ url('dashboard/users') }}">
                                    <div class="input-group">
                                          <input type="text" class="form-control" name="q" value="{{ $request['q'] ?? '' }}">
                                          <div class="input-group-append">
                                                <button type="submit" class="btn btn-secondary btn-sm">Search</button>
                                          </div>
                                          <div class="input-group-append">
                                                <a href="{{ url('dashboard/users/adduser') }}"><button type="button" class="btn btn-primary btn-sm">Add User</button></a>
                                          </div>
                                    </div>
                              </form>
                        </div>
                  </div>
            </div>
            <div class="card-body p-0">
                  <table class="table table-borderless table-striped table-hover">
                        <thead>
                              <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Registered</th>
                                    <th>Edited</th>
                                    <th>Action</th>
                              </tr>
                        </thead>
                        <tbody>
                              @foreach($users as $user)
                              <tr>
                                    <td>{{ ($users->currentPage() - 1) * ($users->perPage()) + $loop->iteration }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>{{ $user->updated_at }}</td>
                                    <td><a href="{{ url('dashboard/user/edit/'.$user->id) }}" class="btn btn-success btn-sm">Edit</a></td>
                              </tr>
                              @endforeach
                        </tbody>
                  </table>
                 
            </div>
            {{ $users->appends($request)->links() }}
      </div>
@endsection