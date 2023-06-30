@extends('layout')

@section('content')
<div class="container mt-5 align-items-center justify-content-center">
  <div class="card p-5">
    <h1>Register</h1>
    <form method="post" action="/register">
      @csrf
      <div class="mb-3">
        <label for="Name" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" placeholder="Masukkan Nama">
      </div>

      <div class="mb-3">
        <label for="Email" class="form-label">Email Address</label>
        <input type="email" name="email" class="form-control" placeholder="Masukkan Email">
      </div>

      <div class="mb-3">
        <label for="Password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
      </div>

      <div class="mb-3">
        <p>Sudah Punya akun? <a href="#">Login Disini</a></p>
      </div>

      <div class="mb-3">
        <button type="submit" class="btn btn-primary">Buat Akun</button>
      </div>

    </form>
  </div>
</div>
@endsection