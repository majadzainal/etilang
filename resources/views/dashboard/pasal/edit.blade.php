@extends('layouts.dashboard')


@section('content')
      <div class="card p-0">
            <div class="card-header">
                  <div class="row">
                        <div class="col-8">
                              <h3>Data Pasal Perkara</h3>
                        </div>
                        <div class="col-4 text-right">
                              <button class="btn btn-sm text-secondary" data-toggle="modal" data-target="#deleteModal">Delete</button>
                        </div>
                  </div>
            </div>
            <div class="card-body p-4">
                  <div class="row">
                        <div class="col-md-12">
                              <form method="post" class="row" action="{{ url('dashboard/pasal/update/'. $pasal->id ) }}">
                                    @csrf
                                    @method('put')
                                    <div class="form-group col-md-12">
                                          <label for="perkara">Perkara</label>
                                          <input type="text" class="form-control" name="perkara" value="{{ old('perkara') ?? $pasal->perkara }}">
                                          @error('nama')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div>             

                                    <div class="form-group col-md-12">
                                          <label for="pasal">Pasal</label>
                                          <input type="text" class="form-control" name="pasal" value="{{ old('pasal') ?? $pasal->pasal }}">
                                          @error('pasal')
                                                <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div> 

                                    <div class="form-group col-md-6">
                                          <label for="denda">Denda (Rp.)</label>
                                          <input type="number" class="form-control" name="denda" value="{{ old('denda') ?? $pasal->denda }}">
                                          @error('denda')
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
                                                      <a href="{{ url('dashboard/pasal/')}}">
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
                              <p>Anda yakin ingin hapus pasal {{ $pasal->perkara }}</p>
                        </div>

                        <div class="modal-footer">
                              <form method="post" action="{{ url('dashboard/pasal/delete/'. $pasal->id) }}">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                              </form>
                        </div>
                  </div>
            </div>
      </div>
@endsection