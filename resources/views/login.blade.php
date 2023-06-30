@extends('layout')

@section('content')
<div class="container mt-5 align-items-center justify-content-center">
  <div class="card p-5">
    <h1>Login</h1>

    <form method="post" action="/login">
      @csrf
      <div class="mb-3">
        <label for="Email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" placeholder="Masukkan Email">
      </div>

      <div class="mb-3">
        <label for="Password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
      </div>

      <div class="mb-3">
        <p>Belum Punya akun? <a href="{{ route('register') }}">Buat Disini</a></p>
      </div>

      <div class="mb-3">
        <button type="submit" class="btn btn-primary">Login</button>
      </div>

    </form>
  </div>
</div>
@endsection