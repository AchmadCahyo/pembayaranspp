@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if (Auth::User()->role == 2)

                @else
                <div class="my-1">
                    <a href="{{ route('pembayaran.create') }}" class="btn btn-danger btn-sm">Eksport</a>
                </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <p><b>Rekapitulasi Pembayaran SPP</b></p>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">Tanggal Bayar</th>
                                    <th scope="col">Bulan</th>
                                    <th scope="col">Tahun | Nominal</th>
                                    <th scope="col">Jumlah Bayar</th>
                                    <th scope="col">Tanggungan</th>
                                    <th scope="col">Admin</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @forelse ($pembayaran as $no => $p)
                                    <tr>
                                        <th scope="row">{{ ++$no }}</th>
                                        <td>{{ $p->siswa->nama ?? ''}}</td>
                                        <td>{{ $p->tanggal_bayar }}</td>
                                        <td>{{ $p->bulan }}</td>
                                        <td>{{ $p->spp->tahun }} |
                                            {{ 'Rp. ' . number_format($p->spp->nominal, 2, ',', '.') }}</td>
                                        <td>{{ 'Rp. ' . number_format($p->total_bayar, 2, ',', '.') }}</td>
                                        <td>
                                            <button class="btn btn-outline-success btn-sm">
                                                {{ 'Rp. ' . number_format($p->spp->nominal - $p->total_bayar, 2, ',', '.') }}
                                            </button>
                                        </td>
                                        <td>{{ $p->nama_penginput }}</td>
                                    @empty
                                        <div class="alert alert-danger" role="alert">
                                            Data SPP Tidak Ditemukan
                                        </div>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $pembayaran->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
