<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Fakultas;
use App\Models\Gelar;
use App\Models\Ijazah;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use App\Models\Rektor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreateDataController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $this->user = Auth::user();

            return $next($request);
        });
    }

    function home(){
        $mahasiswa = Mahasiswa::query()
            ->with('ijazah')
            ->orderBy('created_at', 'desc')
            ->paginate('5');

        return view('create-data', ['mahasiswa' => $mahasiswa]);
    }

    public function listMahasiswa(){
        $mahasiswa = Mahasiswa::query()
            ->with('ijazah')
            ->orderBy('created_at', 'desc')
            ->paginate('5');

        return $mahasiswa;
    }

    public function listFakultas(){
        return Fakultas::query()
            ->get()->toJson();
    }

    public function listProdi(Request $request){
        return ProgramStudi::query()
            ->where('id_fakultas', $request->fakultas)
            ->get()->toJson();
    }

    public function createMahasiswa(){
        return view('mahasiswa.create-mahasiswa', [
            "mahasiswa" => ['status' => 0],
            'url' => 'create-mahasiswa',
            "name" => "Tambah"
        ]);
    }

    public function postMahasiswa(Request $request){
        try {
            DB::beginTransaction();

            $newMahasiswa = new Mahasiswa();

            $newMahasiswa->nama = $request->input('nama');
            $newMahasiswa->npm = $request->input('npm');
            $newMahasiswa->email = $request->input('email');
            $newMahasiswa->tempat_tanggal_lahir = $request->input('tempat-lahir');
            $newMahasiswa->tanggal_lahir = Carbon::createFromFormat('d/m/Y', $request->input('tanggal-lahir'));
            $newMahasiswa->id_fakultas = $request->input('select-fakultas');
            $newMahasiswa->id_prodi = $request->input('select-prodi');
            $newMahasiswa->tahun_masuk = $request->input('tahun-masuk');
            $newMahasiswa->is_graduated = $request->input('status');
            $newMahasiswa->save();

            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();

            return $e;
        }

        return redirect('/mahasiswa')->with('success', 'Data mahasiswa berhasil di input');
    }

    public function detailMahasiswa(Request $request){
        $npm = $request->input('npm');

        $mahasiswa = Mahasiswa::query()
            ->with('fakultas.prodi')
            ->with('ijazah')
            ->where('npm', $npm)
            ->first();

        $dataFakultas = [];
        $fakultas = Fakultas::query()->get();
        foreach ($fakultas as $item){
            $dataFakultas[] = [
                'id' => $item->id_fakultas,
                'nama' => $item->nama
            ];
        }

        $dataProdi = [];
        $prodi = ProgramStudi::query()->where('id_fakultas', $mahasiswa->id_fakultas)->get();
        foreach ($prodi as $item){
            $dataProdi[] = [
                'id' => $item->id_program_studi,
                'nama' => $item->nama
            ];
        }

        $data = [
            'status' => 1,
            'nama' => $mahasiswa->nama,
            'npm' => $mahasiswa->npm,
            'email' => $mahasiswa->email,
            'id_fakultas' => $mahasiswa->id_fakultas,
            'fakultas' => $dataFakultas,
            'id_prodi' => $mahasiswa->id_prodi,
            'prodi' => $dataProdi,
            'ijazah' => $mahasiswa->ijazah,
            'tahun_masuk' => $mahasiswa->tahun_masuk,
            'is_graduated' => $mahasiswa->is_graduated,
            'tempat_lahir' => $mahasiswa->tempat_tanggal_lahir,
            'tanggal_lahir' => Carbon::parse($mahasiswa->tanggal_lahir)->format('m/d/Y'),
        ];

        return view('mahasiswa.create-mahasiswa', [
            "mahasiswa" => $data,
            'url' => 'edit-mahasiswa',
            "name" => "Detail"
        ])->with('status', 'edit');
    }

    public function updateMahasiswa(Request $request){
        try {
            DB::beginTransaction();

            Mahasiswa::query()
                ->where('npm', $request->input('npm'))
                ->update([
                    'nama' => $request->input('nama'),
                    'email' => $request->input('email'),
                    'tempat_tanggal_lahir' => $request->input('tempat-lahir'),
                    'tanggal_lahir' => Carbon::createFromFormat('d/m/Y', $request->input('tanggal-lahir')),
                    'id_fakultas' => $request->input('select-fakultas'),
                    'id_prodi' => $request->input('select-prodi'),
                    'tahun_masuk' => $request->input('tahun-masuk'),
                    'is_graduated' => $request->input('status'),
                ]);


            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();

            return $e;
        }

        return redirect('/mahasiswa');
    }

    public function deleteMahasiswa(){

    }

    public function createIjazah(Request $request){
        // Query model
        $mahasiswa = Mahasiswa::query()->where('npm', $request->input('npm'))->firstOrFail();
        $rektor = Rektor::query()->where('status_jabatan', 1)->firstOrFail();
        $gelar = Gelar::query()->where('id_prodi', $mahasiswa->id_prodi)->firstOrFail();
        $admin = Admin::query()->where('user_id', Auth::id())->firstOrFail();

        // Validate status mahasiswa
        if ($mahasiswa->is_graduated != 1){
            return response()->json([
                'status' => '400',
                'message' => 'Mahasiswa belom memenuhi syarat'
            ])->setStatusCode(400);
        }

        // upload file
        $noIjazah = $request->input('no_ijazah');
        $file = $request->file('file');
        $fileName = "ijazah-" . $request->input('npm') . '.png';
        $file->move('ijazah', $fileName);


        // input data
        try {
            DB::beginTransaction();

            $newIjazah = new Ijazah();

            $newIjazah->no_ijazah = $noIjazah;
            $newIjazah->universitas = "Universitas Ibn Khaldun Bogor";
            $newIjazah->tanggal_keluar = Carbon::now();
            $newIjazah->id_fakultas = $mahasiswa->id_fakultas;
            $newIjazah->npm = $mahasiswa->npm;
            $newIjazah->id_gelar = $gelar->id_gelar;
            $newIjazah->path_img = '/ijazah/'.$fileName;
            $newIjazah->id_rektor = $rektor->id_rektor;
            $newIjazah->id_admin = $admin->id_admin;
            $newIjazah->validated_at = Carbon::now();
            $newIjazah->save();

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();

            return $e;
        }

        return redirect('/mahasiswa');
    }
}
