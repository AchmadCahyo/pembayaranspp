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
                                    <th scope="col">Nama Kelas</th>
                                    <th scope="col">Kompetensi Keahlian</th>
                                    <th scope="col">Opsi</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @forelse ($kelas as $no => $k)
                                    <tr>
                                        <th scope="row">{{ ++$no }}</th>
                                        <td>{{ $k->nama_kelas }}</td>
                                        <td>{{ $k->kompetensi_keahlian }}</td>
                                        <td>
                                            <a href="#" class="btn-md btn btn-secondary"><i
                                                    class="bi bi-pencil-square" data-bs-toggle="modal"
                                                    data-bs-target="#edit{{ $k->id }}"></i></a>
                                            <a href="#" class="btn-md btn btn-danger"><i class="bi bi-x-square"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#delete{{ $k->id }}"></i></a>
                                        </td>
                                    @empty
                                        <div class="alert alert-danger" role="alert">
                                            Data Kelas Tidak Ditemukan
                                        </div>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $kelas->links() }}
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
                    <form action="{{ route('kelas.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Kelas</label>
                            <input type="text" class="form-control" name="nama_kelas"
                                @error('nama_kelas')
                            is-invalid
                            @enderror
                                placeholder="Masukkan Nama Kelas">

                            @error('nama_kelas')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kompetensi Keahlian</label>
                            <input type="text" class="form-control" name="kompetensi_keahlian"
                                @error('kompetensi_keahlian')
                            is-invalid
                            @enderror
                                placeholder="Masukkan Nama Kompetensi Keahlian">

                            @error('kompetensi_keahlian')
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
    @foreach ($kelas as $k)
    <div class="modal fade" id="edit{{ $k->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Kelas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kelas.update', $k->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Nama Kelas</label>
                            <input type="text" class="form-control" name="nama_kelas"
                                @error('nama_kelas')
                            is-invalid
                            @enderror
                                placeholder="Masukkan Nama Kelas" value="{{ old('nama_kelas', $k->nama_kelas) }}">

                            @error('nama_kelas')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kompetensi Keahlian</label>
                            <input type="text" class="form-control" name="kompetensi_keahlian"
                                @error('kompetensi_keahlian')
                            is-invalid
                            @enderror
                                placeholder="Masukkan Nama Kompetensi Keahlian"
                                value="{{ old('kompetensi_keahlian', $k->kompetensi_keahlian) }}">

                            @error('kompetensi_keahlian')
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
    @foreach ($kelas as $k)
        <div class="modal fade" id="delete{{ $k->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data Kelas</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda Ingin Menghapus Data <b>{{ $k->nama_kelas }}</b> ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                        <form action="{{ route('kelas.destroy', $k->id) }}" method="POST">
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
