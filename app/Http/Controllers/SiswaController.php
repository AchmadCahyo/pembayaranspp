<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::with('kelas')->paginate(5);
        $kelas = Kelas::all();
        $spp = Spp::all();
        return view('admin.siswa.index', compact('siswa', 'kelas', 'spp'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nisn' => 'required',
            'nis' => 'required',
            'nama' => 'required',
            'kelas_id' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'spp_id' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $siswa = Siswa::create([
            'nisn' => $request->input('nisn'),
            'nis' => $request->input('nis'),
            'nama' => $request->input('nama'),
            'kelas_id' => $request->input('kelas_id'),
            'alamat' => $request->input('alamat'),
            'no_telp' => $request->input('no_telp'),
            'spp_id' => $request->input('spp_id'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        if ($siswa) {
            return redirect()->route('siswa.index')->with('sukses', 'Data Siswa Berhasil Ditambahkan');

        } else {
            return redirect()->route('siswa.index')->with('error', 'Data Siswa Gagal Ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'nisn' => 'required',
            'nis' => 'required',
            'nama' => 'required',
            'kelas_id' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'spp_id' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update([
            'nisn' => $request->input('nisn'),
            'nis' => $request->input('nis'),
            'nama' => $request->input('nama'),
            'kelas_id' => $request->input('kelas_id'),
            'alamat' => $request->input('alamat'),
            'no_telp' => $request->input('no_telp'),
            'spp_id' => $request->input('spp_id'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        if ($siswa) {
            return redirect()->route('siswa.index')->with('sukses', 'Data Berhasil Di Perbaharui');

        } else {
            return redirect()->route('siswa.index')->with('error', 'Data Gagal Di Perbaharui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        if ($siswa) {
            return redirect()->route('siswa.index')->with('sukses', 'Data Berhasil Di Hapus');

        } else {
            return redirect()->route('siswa.index')->with('error', 'Data Gagal Di Perbaharui');
        }
    }
}
