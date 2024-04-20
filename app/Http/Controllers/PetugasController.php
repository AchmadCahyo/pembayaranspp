<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $petugas = User::paginate(5);
        return view('admin.petugas.index', compact('petugas'));
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
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        $petugas = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role')
        ]);

        if($petugas) {
            return redirect()->route('petugas.index')->with('sukses', 'Data Kelas Berhasil Ditambahkan');

        }else {
            return redirect()->route('petugas.index')->with('error', 'Data Kelas Gagal Ditambahkan');
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
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        $petugas = User::findOrFail($id);
        $petugas->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role')
        ]);

        if($petugas) {
            return redirect()->route('petugas.index')->with('sukses', 'Data Berhasil Di Perbaharui');

        }else {
            return redirect()->route('petugas.index')->with('error', 'Data Gagal Di Perbaharui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $petugas = User::findOrFail($id);
        $petugas->delete();

        if($petugas) {
            return redirect()->route('petugas.index')->with('sukses', 'Data Berhasil Di Hapus');

        }else {
            return redirect()->route('petugas.index')->with('error', 'Data Gagal Di Perbaharui');
        }
    }
}
