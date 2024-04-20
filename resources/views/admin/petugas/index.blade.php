@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if ($message = Session::get('sukses'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="#" class="btn-md btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#tambah">Tambah
                            Data</a>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Petugas</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Opsi</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @forelse ($petugas as $no => $p)
                                    <tr>
                                        <th scope="row">{{ ++$no }}</th>
                                        <td>{{ $p->name}}</td>
                                        <td>{{ $p->email }}</td>
                                        <td>
                                            <a href="#" class="btn-md btn btn-secondary"><i
                                                    class="bi bi-pencil-square" data-bs-toggle="modal"
                                                    data-bs-target="#edit{{ $p->id }}"></i></a>
                                            <a href="#" class="btn-md btn btn-danger"><i class="bi bi-x-square"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#delete{{ $p->id }}"></i></a>
                                        </td>
                                    @empty
                                        <div class="alert alert-danger" role="alert">
                                            Data Kelas Tidak Ditemukan
                                        </div>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $petugas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modal')
    {{-- Modal Tambah Data --}}
    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Kelas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('petugas.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Petugas</label>
                            <input type="text" class="form-control" name="name"
                                @error('name')
                            is-invalid
                            @enderror
                                placeholder="Masukkan Nama Petugas">

                            @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email"
                                @error('email')
                            is-invalid
                            @enderror
                                placeholder="Masukkan Email">

                            @error('email')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password"
                                @error('password')
                            is-invalid
                            @enderror
                                placeholder="Masukkan Password">

                            @error('password')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="hidden" class="form-control" name="role" value="2"
                                @error('role')
                            is-invalid
                            @enderror
                                placeholder="Masukkan role">

                            @error('role')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit Data --}}
    @foreach ($petugas as $p)
    <div class="modal fade" id="edit{{ $p->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Petugas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kelas.update', $p->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Nama Petugas</label>
                            <input type="text" class="form-control" name="name"
                                @error('name')
                            is-invalid
                            @enderror
                                placeholder="Masukkan Nama Kelas" value="{{ old('name', $p->name) }}">

                            @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" name="email"
                                @error('email')
                            is-invalid
                            @enderror
                                placeholder="Masukkan Nama Kompetensi Keahlian"
                                value="{{ old('email', $p->email) }}">

                            @error('email')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password"
                                @error('password')
                            is-invalid
                            @enderror
                                placeholder="Masukkan Nama Kompetensi Keahlian"
                                value="{{ old('password', $p->password) }}">

                            @error('password')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="hidden" class="form-control" name="role" value="2"
                                @error('role')
                            is-invalid
                            @enderror
                                placeholder="Masukkan role">

                            @error('role')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    {{-- Modal Hapus Data --}}
    @foreach ($petugas as $p)
        <div class="modal fade" id="delete{{ $p->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data Kelas</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda Ingin Menghapus Data <b>{{ $p->name }}</b> ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                        <form action="{{ route('petugas.destroy', $p->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endforeach
@endpush
