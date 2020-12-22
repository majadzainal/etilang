@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verifikasi email pendaftaran user</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                    Anda tidak di izinkan sebelum melakukan proses verifikasi email anda. Silakan cek email pendaftaran.
                    Jika tidak menerima email verifikasi,
                    <form class="d-inline" method="POST" action="/email/verification-notification">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">klik di sini untuk mengirim ulang email verifikasi.</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
