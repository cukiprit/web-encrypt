@extends('layout')

@section('content')
<div class="content">
    <main class="container">
        <div class="my-5 p-5 bg-body rounded shadow-sm">
            <div class="container ">
                <div class="row ">
                    <div class=" justify-content-around">
                        <div class="four">

                            <div class="row mb-4">
                                <h1 style="text-align: center">ENCRYPTED FILES</h1>
                            </div>

                            <main class="container">
                                <div class="my-3 p-3 bg-body rounded shadow-sm ">

                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="col-md-2">Nama File</th>
                                                <th class="col-md-2">Deskripsi</th>
                                                <th class="col-md-2">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($file->count())
                                            @foreach ($file as $encryptedFile)
                                            <tr>
                                                <td>{{$encryptedFile->nama_file}}</td>
                                                <td>{{$encryptedFile->description}}</td>
                                                <td>
                                                    <form action="{{ route('download', $encryptedFile->id) }}" method="POST">
                                                        @csrf
                                                        <input class="" type="password" name="dekrip_key" placeholder="Enter Decryption Key" required>
                                                        <button class="btn btn-primary" type="submit">Download</button>
                                                    </form>
                                                    <!-- {{-- <a href="#" class="btn btn-danger" onclick="deleteData({{ $encryptedFile->id }})">Delete</a> --}} -->
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </main>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection