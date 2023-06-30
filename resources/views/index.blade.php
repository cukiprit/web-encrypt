@extends('layout')

@section('content')
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Dashboard</div>
        <div class="card-body">
          <h2 class="text-center">
            Selamat Datang {{ auth()->user()->name }}
          </h2>

          <div class="mt-4">
            <h4 class="text-center">List Data yang di encrypt</h4>
            <p>Data yang telah di enkripsi: {{ $data->count() }}</p>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th class="col-md-3">Nama File</th>
                  <th class="col-md-3">Nama File (Enkripsi)</th>
                  <th class="col-md-3">Encrypt key</th>
                  <th class="col-md-3">Deksripsi</th>
                </tr>
              </thead>

              <tbody>
                @if($data->count())
                @foreach ($data as $dataEncrypt)
                <tr>
                  <td>{{ $dataEncrypt->nama_file }}</td>
                  <td>{{ $dataEncrypt->enkrip_file }}</td>
                  <td>{{ $dataEncrypt->enkrip_key }}</td>
                  <td>{{ $dataEncrypt->description }}</td>
                </tr>
                @endforeach
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection