<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Ktp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Dashboard\PetugasController;

class KtpController extends Controller
{
    private $obj_petugas;
    public function __construct()
    {
        $this->obj_petugas = new PetugasController();
    }

    public function index(Request $request, Ktp $ktps)
    {
        $active = 'ktp';

        $q = $request->input('q');

        $ktps = $ktps->when($q, function($query) use ($q) {
                    return $query->where('nik', 'like', '%'.$q.'%')
                                    ->orWhere('nama', 'like', '%'.$q.'%');
                })
                ->paginate(10);
        
        $request = $request->all();
        return view('dashboard.ktp.index', compact('ktps', 'active', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active = 'ktp';
        $jenis_kelamin = $this->obj_petugas->JenisKelamin();
        $status_perkawinan = $this->obj_petugas->StatusPerkawinan();


        return view('dashboard.ktp.create', 
                    compact('active',
                            'jenis_kelamin',
                            'status_perkawinan')
                );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Ktp $ktps)
    {
        $validator = $request->validate([
            'email'              => 'required|unique:ktp,email,',
            'nama'               => 'required',
            'nik'                => 'required|unique:ktp,nik',
            'tempat_lahir'       => 'required',
            'tanggal_lahir'      => 'required',
            'jenis_kelamin'      => 'required',
            'alamat'             => 'required',
            'agama'              => 'required',
            'status_perkawinan'  => 'required',
            'pekerjaan'          => 'required',
            'kewarganegaraan'    => 'required'
        ]);
        
        $ktp = Ktp::create([
            'email'              => $request->email,
            'nama'               => $request->nama,
            'nik'                => $request->nik,
            'tempat_lahir'       => $request->tempat_lahir,
            'tanggal_lahir'      => $request->tanggal_lahir,
            'jenis_kelamin'      => $request->jenis_kelamin,
            'alamat'             => $request->alamat,
            'agama'              => $request->agama,
            'status_perkawinan'  => $request->status_perkawinan,
            'pekerjaan'          => $request->pekerjaan,
            'kewarganegaraan'    => $request->kewarganegaraan
        ]);



        $active = 'ktp';

        $q = $request->input('q');

        $ktps = $ktps->when($q, function($query) use ($q) {
                    return $query->where('nik', 'like', '%'.$q.'%')
                                    ->orWhere('nama', 'like', '%'.$q.'%');
                })
                ->paginate(10);
        
        $request = $request->all();
        return view('dashboard.ktp.index', compact('ktps', 'active', 'request'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $active = 'ktp';
        $ktp = Ktp::find($id);

        $jenis_kelamin = $this->obj_petugas->JenisKelamin();
        $status_perkawinan = $this->obj_petugas->StatusPerkawinan();

        return view('dashboard.ktp.edit', 
                    compact('active',
                            'jenis_kelamin',
                            'status_perkawinan',
                            'ktp')
                );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Ktp $ktps)
    {
        $validator = $request->validate([
            'email'              => 'required|unique:ktp,email,'.$id,
            'nama'               => 'required',
            'nik'                => 'required|unique:ktp,nik,'.$id,
            'tempat_lahir'       => 'required',
            'tanggal_lahir'      => 'required',
            'jenis_kelamin'      => 'required',
            'alamat'             => 'required',
            'agama'              => 'required',
            'status_perkawinan'  => 'required',
            'pekerjaan'          => 'required',
            'kewarganegaraan'    => 'required'
        ]);
        
        $ktp = Ktp::find($id);
        $ktp = $ktp->update([
            'email'              => $request->email,
            'nama'               => $request->nama,
            'nik'                => $request->nik,
            'tempat_lahir'       => $request->tempat_lahir,
            'tanggal_lahir'      => $request->tanggal_lahir,
            'jenis_kelamin'      => $request->jenis_kelamin,
            'alamat'             => $request->alamat,
            'agama'              => $request->agama,
            'status_perkawinan'  => $request->status_perkawinan,
            'pekerjaan'          => $request->pekerjaan,
            'kewarganegaraan'    => $request->kewarganegaraan
        ]);


        $active = 'ktp';

        $q = $request->input('q');

        $ktps = $ktps->when($q, function($query) use ($q) {
                    return $query->where('nik', 'like', '%'.$q.'%')
                                    ->orWhere('nama', 'like', '%'.$q.'%');
                })
                ->paginate(10);
        
        $request = $request->all();
        return view('dashboard.ktp.index', compact('ktps', 'active', 'request'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, Ktp $ktps)
    {
        $ktp = Ktp::find($id);
        $ktp->delete();

        $active = 'ktp';

        $q = $request->input('q');
        $ktps = $ktps->when($q, function($query) use ($q) {
                    return $query->where('nik', 'like', '%'.$q.'%')
                                    ->orWhere('nama', 'like', '%'.$q.'%');
                })
                ->paginate(10);
        
        $request = $request->all();
        return view('dashboard.ktp.index', compact('ktps', 'active', 'request'));
    }
}
