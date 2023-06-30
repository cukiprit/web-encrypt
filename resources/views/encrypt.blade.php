@extends('layout')

@section('content')
<div class="content">
    <main class="container">
        <div class="my-5 p-5 bg-body rounded shadow-sm">
            <div class="container ">
                <div class="row ">
                    <div class="d-flex justify-content-around">
                        <div class="four">
                            <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                                @endif
                                <div class="row mb-4">
                                    <h1 style="text-align: center">ENCRYPTION FILE</h1>
                                </div>
                                <div class="row w-10">
                                    <div class="row mb-4 ">
                                        <label class="form-label" for="file">Pilih file PDF:</label>
                                        <input class="form-control" class="inputpdf" type="file" name="file" accept=".pdf" required>
                                    </div>
                                    <div class="row mb-4 ">
                                        <label class="form-label" for="deskripsi">Nama File:</label>
                                        <input class="form-control" type="text" name="nama_file" required>
                                    </div>

                                    <div class="row mb-4 ">
                                        <label class="form-label" for="deskripsi">Deskripsi:</label>
                                        <input class="form-control" type="text" name="description" required>
                                    </div>

                                    <div class="row mb-4 ">
                                        <label class="form-label" for="enkrip_key">Kunci enkripsi:</label>
                                        <input class="form-control" type="text" name="enkrip_key" required>
                                    </div>
                                    <br>
                                    <button class="btn btn-primary" type="submit">Enkripsi file</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</div>
@endsection