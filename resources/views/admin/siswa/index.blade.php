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
                    @if (Auth::User()->role == 2)
                        <div class="card-header">
                            <p><b>Data Siswa</b></p>
                        </div>
                    @else
                        <div class="card-header">
                            <a href="#" class="btn-md btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#tambah">Tambah
                                Data</a>
                        </div>
                    @endif

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">NISN | NIS</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Nomor Telfon</th>
                                    <th scope="col">Opsi</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @forelse ($siswa as $no => $s)
                                    <tr>
                                        <th scope="row">{{ ++$no }}</th>
                                        <td>{{ $s->nisn }} | {{ $s->nis }}</td>
                                        <td>{{ $s->nama }}</td>
                                        <td>{{ $s->kelas->nama_kelas }}</td>
                                        <td>{{ $s->no_telp }}</td>
                                        <td>
                                            @if (Auth::User()->role == 2)
                                                <div class="dropdown my-2">
                                                    <button class="btn btn-info dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        Status
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('pembayaran.show', $s->id) }}">Riwayat</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                                data-bs-target="#bayar{{ $s->id }}">Bayar</a></li>
                                                    </ul>
                                                </div>
                                            @else
                                                <a href="#" class="btn-sm btn btn-secondary"><i
                                                        class="bi bi-pencil-square" data-bs-toggle="modal"
                                                        data-bs-target="#edit{{ $s->id }}"></i></a>
                                                <a href="#" class="btn-sm btn btn-warning"><i class="bi bi-eye-fill"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#lihat{{ $s->id }}"></i></a>
                                                <a href="#" class="btn-sm btn btn-danger"><i class="bi bi-x-square"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#delete{{ $s->id }}"></i></a><br>
                                                <div class="dropdown my-2">
                                                    <button class="btn btn-info dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        Status
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('pembayaran.show', $s->id) }}">Riwayat</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                                data-bs-target="#bayar{{ $s->id }}">Bayar</a></li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </td>
                                    @empty
                                        <div class="alert alert-danger" role="alert">
                                            Data siswa Tidak Ditemukan
                                        </div>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $siswa->links() }}
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Siswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('siswa.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Siswa</label>
                            <input type="text" class="form-control" name="nama"
                                @error('nama')
                            is-invalid
                            @enderror
                                placeholder="Masukkan Nama">

                            @error('nama')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email Siswa</label>
                            <input type="email" class="form-control" name="email"
                                @error('email')
                            is-invalid
                            @enderror
                                placeholder="Masukkan email">

                            @error('email')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password Siswa</label>
                            <input type="password" class="form-control" name="password"
                                @error('password')
                            is-invalid
                            @enderror
                                placeholder="Masukkan password">

                            @error('password')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">NISN</label>
                            <input type="number" class="form-control" name="nisn"
                                @error('nisn')
                            is-invalid
                            @enderror
                                placeholder="Masukkan nisn siswa">

                            @error('nisn')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">NIS</label>
                            <input type="number" class="form-control" name="nis"
                                @error('nis')
                            is-invalid
                            @enderror
                                placeholder="Masukkan nis siswa">

                            @error('nis')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kelas</label>
                            <select
                                class="form-select @error('kelas_id')
                                is-invalid
                            @enderror"
                                aria-label="Pilih Kelas" name="kelas_id">
                                <option selected>Pilih Kelas di Bawah</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                @endforeach
                            </select>

                            @error('kelas_id')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nomor Telfon</label>
                            <input type="number" class="form-control" name="no_telp"
                                @error('no_telp')
                            is-invalid
                            @enderror
                                placeholder="Masukkan no_telp siswa">

                            @error('no_telp')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <input type="text" class="form-control" name="alamat"
                                @error('alamat')
                            is-invalid
                            @enderror
                                placeholder="Masukkan alamat siswa">

                            @error('alamat')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">SPP</label>
                            <select
                                class="form-select @error('spp_id')
                                is-invalid
                            @enderror"
                                aria-label="Pilih Masa SPP" name="spp_id">
                                <option selected>Pililh SPP di Bawah</option>
                                @foreach ($spp as $s)
                                    <option value="{{ $s->id }}">{{ $s->tahun }}</option>
                                @endforeach
                            </select>

                            @error('spp_id')
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
    @foreach ($siswa as $s)
        <div class="modal fade" id="edit{{ $s->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Siswa</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('siswa.update', $s->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Nama Siswa</label>
                                <input type="text" class="form-control" name="nama"
                                    @error('nama')
                                is-invalid
                                @enderror
                                    placeholder="Masukkan Nama" value="{{ old('nama', $s->nama) }}">

                                @error('nama')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Siswa</label>
                                <input type="email" class="form-control" name="email"
                                    @error('email')
                                is-invalid
                                @enderror
                                    placeholder="Masukkan email" value="{{ old('email', $s->email) }}">

                                @error('email')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password Siswa</label>
                                <input type="password" class="form-control" name="password"
                                    @error('password')
                                is-invalid
                                @enderror
                                    placeholder="Masukkan password" value="{{ old('password', $s->password) }}">

                                @error('password')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">NISN</label>
                                <input type="number" class="form-control" name="nisn"
                                    @error('nisn')
                                is-invalid
                                @enderror
                                    placeholder="Masukkan nisn siswa" value="{{ old('nisn', $s->nisn) }}" readonly>

                                @error('nisn')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">NIS</label>
                                <input type="number" class="form-control" name="nis"
                                    @error('nis')
                                is-invalid
                                @enderror
                                    placeholder="Masukkan nis siswa" value="{{ old('nis', $s->nis) }}" readonly>

                                @error('nis')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kelas</label>
                                <select
                                    class="form-select @error('kelas_id')
                                    is-invalid
                                @enderror"
                                    aria-label="Pilih Kelas" name="kelas_id">
                                    <option selected>{{ $s->kelas_id }}</option>
                                    @foreach ($kelas as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                    @endforeach
                                </select>

                                @error('kelas_id')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nomor Telfon</label>
                                <input type="number" class="form-control" name="no_telp"
                                    @error('no_telp')
                                is-invalid
                                @enderror
                                    placeholder="Masukkan no_telp siswa" value="{{ old('no_telp', $s->no_telp) }}">

                                @error('no_telp')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <input type="text" class="form-control" name="alamat"
                                    @error('alamat')
                                is-invalid
                                @enderror
                                    placeholder="Masukkan alamat siswa" value="{{ old('alamat', $s->alamat) }}">

                                @error('alamat')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">SPP</label>
                                <select
                                    class="form-select @error('spp_id')
                                    is-invalid
                                @enderror"
                                    aria-label="Pilih Masa SPP" name="spp_id">
                                    <option selected>{{ $s->spp_id }}</option>
                                    @foreach ($spp as $s)
                                        <option value="{{ $s->id }}">{{ $s->tahun }}</option>
                                    @endforeach
                                </select>

                                @error('spp_id')
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

    @foreach ($siswa as $s)
        <div class="modal fade" id="lihat{{ $s->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data Siswa</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Nama Siswa : <b>{{ $s->nama }}</b></p>
                        <p>NISN | NIS : <b>{{ $s->nisn }} | {{ $s->nis }}</b></p>
                        <p>Alamat : <b>{{ $s->alamat }}</b></p>
                        <p>Nomor Telfon : <b>{{ $s->no_telp }}</b></p>
                        <p>Kelas : <b>{{ $s->kelas->nama_kelas }}</b></p>
                        <p>Tahun SPP : <b>{{ $s->spp->tahun }}</b></p>
                        <p>Nominal SPP : <b>{{ 'Rp. ' . number_format($s->spp->nominal, 2, ',', '.') }}</b></p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Modal Hapus Data --}}
    @foreach ($siswa as $s)
        <div class="modal fade" id="delete{{ $s->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data siswa</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda Ingin Menghapus Data Ini?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                        <form action="{{ route('siswa.destroy', $s->id) }}" method="POST">
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

    {{-- modal bayar --}}
    @foreach ($siswa as $s)
        <div class="modal fade" id="bayar{{ $s->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Bayar SPP Siswa</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('pembayaran.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nama Siswa</label>
                                <input type="text" class="form-control" name="nama"
                                    @error('nama')
                                is-invalid
                                @enderror
                                    placeholder="Masukkan Nama" value="{{ old('nama', $s->nama) }}" readonly>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="siswa_id"
                                    @error('siswa_id')
                                is-invalid
                                @enderror
                                    placeholder="Masukkan Nama Siswa" value="{{ old('siswa_id', $s->id) }}" hidden>

                                @error('siswa_id')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Pembayaran</label>
                                <input type="date" class="form-control" name="tanggal_bayar"
                                    @error('tanggal_bayar')
                                is-invalid
                                @enderror
                                    placeholder="Masukkan Tanggal Pembayaran ">

                                @error('tanggal_bayar')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Bulan</label>
                                <select
                                    class="form-select @error('bulan')
                                    is-invalid
                                @enderror"
                                    aria-label="Pilih Kelas" name="bulan">
                                    <option selected>Masukkan Bulan Pembayaran</option>
                                    <option value="Januari">Januari</option>
                                    <option value="Februari">Februari</option>
                                    <option value="Maret">Maret</option>
                                    <option value="April">April</option>
                                    <option value="Mei">Mei</option>
                                    <option value="Juni">Juni</option>
                                    <option value="Juli">Juli</option>
                                    <option value="Agustus">Agustus</option>
                                    <option value="September">September</option>
                                    <option value="Oktober">Oktober</option>
                                    <option value="November">November</option>
                                    <option value="Desember">Desember</option>
                                </select>

                                @error('bulan')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">SPP</label>
                                <select
                                    class="form-select @error('spp_id')
                                is-invalid
                                @enderror"
                                    name="spp_id" aria-label="Pilih Masa SPP">
                                    <option value="{{ $s->spp_id }}" selected>{{ $s->spp->nominal }}</option>
                                </select>
                                @error('total_bayar')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jumlah Bayar</label>
                                <input type="number" class="form-control" name="total_bayar"
                                    @error('total_bayar')
                                is-invalid
                                @enderror
                                    placeholder="Masukkan Nominal Bayar">

                                @error('total_bayar')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Administrator</label>
                                <input type="text" class="form-control" name="nama_penginput"
                                    @error('nama_penginput')
                                is-invalid
                                @enderror
                                    placeholder="Masukkan Nama Admin" value="{{ Auth::user()->name }}" readonly>

                                @error('nama_penginput')
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
@endpush
