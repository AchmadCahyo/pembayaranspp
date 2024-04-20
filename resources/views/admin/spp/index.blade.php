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
                                    <th scope="col">Tahun</th>
                                    <th scope="col">Nominal</th>
                                    <th scope="col">Opsi</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @forelse ($spp as $no => $s)
                                    <tr>
                                        <th scope="row">{{ ++$no }}</th>
                                        <td>{{ $s->tahun }}</td>
                                        <td>{{ 'Rp. ' . number_format($s->nominal, 2, ',', '.') }}</td>
                                            <td>
                                                <a href="#" class="btn-md btn btn-secondary"><i
                                                        class="bi bi-pencil-square" data-bs-toggle="modal"
                                                        data-bs-target="#edit{{ $s->id }}"></i></a>
                                                <a href="#" class="btn-md btn btn-danger"><i class="bi bi-x-square"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#delete{{ $s->id }}"></i></a>
                                            </td>
                                        @empty
                                            <div class="alert alert-danger" role="alert">
                                                Data SPP Tidak Ditemukan
                                            </div>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $spp->links() }}
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Spp</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('spp.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Tahun</label>
                            <input type="number" class="form-control" name="tahun"
                                @error('tahun')
                            is-invalid
                            @enderror
                                placeholder="Masukkan Tahun">

                            @error('tahun')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nominal</label>
                            <input type="number" class="form-control" name="nominal"
                                @error('nominal')
                            is-invalid
                            @enderror
                                placeholder="Masukkan Nominal SPP">

                            @error('nominal')
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
    @foreach ($spp as $s)
        <div class="modal fade" id="edit{{ $s->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data SPP</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('spp.update', $s->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Tahun</label>
                                <input type="number" class="form-control" name="tahun"
                                    @error('tahun')
                            is-invalid
                            @enderror
                                    placeholder="Masukkan Tahun" value="{{ old('tahun', $s->tahun) }}">

                                @error('tahun')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nominal</label>
                                <input type="number" class="form-control" name="nominal"
                                    @error('nominal')
                            is-invalid
                            @enderror
                                    placeholder="Masukkan Nominal SPP" value="{{ old('nominal', $s->nominal) }}">

                                @error('nominal')
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
    @foreach ($spp as $s)
        <div class="modal fade" id="delete{{ $s->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data SPP</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda Ingin Menghapus Data Ini?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                        <form action="{{ route('spp.destroy', $s->id) }}" method="POST">
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
