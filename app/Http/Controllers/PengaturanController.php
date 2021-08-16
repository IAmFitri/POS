<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaturan;

class pengaturanController extends Controller
{
    public function index()
    {
        return view('pengaturan.index');
    }

    public function show()
    {
        return Pengaturan::first();
    }

    public function update(Request $request)
    {
        $pengaturan = Pengaturan::first();
        $pengaturan->nama_perusahaan = $request->nama_perusahaan;
        $pengaturan->telepon = $request->telepon;
        $pengaturan->alamat = $request->alamat;
        $pengaturan->diskon = $request->diskon;
        $pengaturan->tipe_nota = $request->tipe_nota;

        if ($request->hasFile('path_logo')) {
            $file = $request->file('path_logo');
            $nama = 'logo-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img'), $nama);

            $pengaturan->path_logo = "/img/$nama";
        }

        if ($request->hasFile('path_kartu_anggota')) {
            $file = $request->file('path_kartu_anggota');
            $nama = 'logo-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img'), $nama);

            $pengaturan->path_kartu_anggota = "/img/$nama";
        }

        $pengaturan->update();

        return response()->json('Data berhasil disimpan', 200);
    }
}