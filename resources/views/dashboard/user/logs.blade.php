@extends('layouts.dashboard')


@section('content')
      <div class="card p-0">
            <div class="card-header">
                  <div class="row">
                        <div class="col-8">
                              <h3>Logs</h3>
                        </div> 
                        <div class="col-4">
                              <form method="get" action="{{ url('dashboard/logs') }}">
                                    <div class="input-group">
                                          <input type="text" class="form-control" name="q" value="{{ $request['q'] ?? '' }}">
                                          <div class="input-group-append">
                                                <button type="submit" class="btn btn-secondary btn-sm">Search</button>
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
                                    <th>Date Logs</th>
                                    <th>Username</th>
                                    <th>Description</th>
                              </tr>
                        </thead>
                        <tbody>
                              @foreach($logs as $log)
                              <tr>
                                    <td>{{ ($logs->currentPage() - 1) * ($logs->perPage()) + $loop->iteration }}</td>
                                    <td>{{ $log->created_at }}</td>
                                    <td>{{ $log->username }}</td>
                                    <td>{{ $log->description }}</td>
                              </tr>
                              @endforeach
                        </tbody>
                  </table>
                 
            </div>
            {{ $logs->appends($request)->links() }}
      </div>
@endsection