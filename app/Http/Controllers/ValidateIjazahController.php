<?php

namespace App\Http\Controllers;

use App\Models\Ijazah;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class ValidateIjazahController extends Controller
{
    public function validateIjazah(Request $request){
        $npm = $request->input('npm');
        $noijazah = $request->input('no_ijazah');

        $mahasiswa = [];
        if($npm != '' && $noijazah != ''){
            $mahasiswa = Mahasiswa::query()
                ->where('npm', $npm)
                ->with('ijazah')
                ->first();

            $ijazah = Ijazah::query()
                ->where('npm', $npm)
                ->where('no_ijazah', $noijazah)
                ->with(['mahasiswa.prodi', 'mahasiswa.fakultas'])
                ->first();
        }
        elseif ($npm != ''){
            $mahasiswa = Mahasiswa::query()
                ->where('npm', $npm)
                ->with('ijazah')
                ->first();

            $ijazah = Ijazah::query()
                ->where('npm', $npm)
                ->with(['mahasiswa.prodi', 'mahasiswa.fakultas'])
                ->first();
        }
        elseif ($noijazah != ''){
            $ijazah = Ijazah::query()
                ->where('no_ijazah', $noijazah)
                ->with(['mahasiswa.prodi', 'mahasiswa.fakultas'])
                ->first();
        }
        else {
            return response()->json([
                'status' => 400,
                'message' => 'Data tidak ada yang di input'
            ])->setStatusCode(400);
        }

        if ($mahasiswa !== []){
            if ($mahasiswa->ijazah = null){
                return response()->json([
                    'status' => 400,
                    'message' => 'Mahasiswa belum memenhui kriteria mendapatkan ijazah',
                ])->setStatusCode(400);
            }
        }

        if (!$ijazah){
            return response()->json([
                'status' => 400,
                'message' => 'Data yang di input tidak cocok dengan ada yang di database, mohon periksa kembali',
            ])->setStatusCode(400);
        } else {
            return $ijazah;
        }
    }

    public function storefile(Request $request){
        $store = Storage::putFileAs('ijazah', $request->file('file'), 'ijazah.png');
        $request->file->move(public_path('ijazah'), 'ijazah.png');


//        $url = Storage::url('ijazah.png');

        return URL::asset('ijazah/ijazah.png');
    }
}
