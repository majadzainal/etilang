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
      @endif
      <div class="card p-0">
            <div class="card-header">
                  <div class="row">
                        <div class="col-6">
                              <h3>Data Pasal Perkara</h3>
                        </div>
                        <div class="col-6">
                              <form method="get" action="{{ url('dashboard/pasal') }}">
                                    <div class="input-group">
                                          <input type="text" class="form-control" name="q" value="{{ $request['q'] ?? '' }}">
                                          <div class="input-group-append">
                                                <button type="submit" class="btn btn-secondary btn-sm">Search</button>
                                          </div>
                                          <div class="input-group-append">
                                                <a href="{{ url('dashboard/pasal/create') }}"><button type="button" class="btn btn-primary btn-sm">Add Pasal Perkara</button></a>
                                          </div>
                                    </div>
                              </form>
                        </div>
                  </div>
            </div>
            <div class="card-body p-0">
                  <div class="rightScrol">
                        <table class="table table-borderless table-striped table-hover">
                              <thead>
                                    <tr>
                                          <th>#</th>
                                          <th>Perkara</th>
                                          <th>Pasal</th>
                                          <th>Denda</th>
                                          <th>Edited</th>
                                          <th>Action</th>
                                    </tr>
                              </thead>
                              <tbody>
                                    @foreach($pasals as $pas)
                                    <tr>
                                          <td>{{ ($pasals->currentPage() - 1) * ($pasals->perPage()) + $loop->iteration }}</td>
                                          <td>{{ $pas->perkara }}</td>
                                          <td>{{ $pas->pasal }}</td>
                                          <td><span>Rp. {{ number_format($pas->denda) }}</span></td>
                                          <td>{{ $pas->updated_at }}</td>
                                          <td><a href="{{ url('dashboard/pasal/edit/'.$pas->id) }}" class="btn btn-success btn-sm">Edit</a></td>
                                    </tr>
                                    @endforeach
                              </tbody>
                        </table>
                  </div>
            </div>
            {{ $pasals->appends($request)->links() }}
      </div>
@endsection