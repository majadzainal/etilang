<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Foto;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function NotHaveAccess()
    {
        $active = 'dashboard';
        return view('auth.security', compact('active'));
    }
    public function index()
    {
        $active = 'dashboard';
        $notif = 'none';
        $nik = '';

        $pelanggaran = DB::table('pelanggaran')
                        ->leftJoin('petugas', 'pelanggaran.petugas_id', '=', 'petugas.id')
                        ->select('pelanggaran.id', 'pelanggaran.nik', 'pelanggaran.created_at', 'pelanggaran.status', 'pelanggaran.paid', 'petugas.name')
                        ->whereIn('pelanggaran.status', ['finish', 'done'])
                        ->whereIn('pelanggaran.paid', ['waiting', 'tilang'])
                        ->orderBy('pelanggaran.created_at', 'DESC')
                        ->get();

        return view('home', compact('active', 'notif', 'nik', 'pelanggaran'));
    }

    public function CariPelanggaranArchive(Request $request)
    {
        return redirect('/dashboard/pelanggaran/caripelanggaranarchivebynik/'.$request->nik);
    }

    public function CariPelanggaranArchiveByNik($nik)
    {
        $active = 'dashboard';
        $notif = 'none';

        $pelanggaran = DB::table('pelanggaran')
                        ->leftJoin('petugas', 'pelanggaran.petugas_id', '=', 'petugas.id')
                        ->select('pelanggaran.id', 'pelanggaran.nik', 'pelanggaran.created_at', 'pelanggaran.status', 'pelanggaran.paid', 'petugas.name')
                        ->whereIn('pelanggaran.status', ['finish', 'done'])
                        ->whereIn('pelanggaran.paid', ['waiting', 'tilang'])
                        ->where('pelanggaran.nik', $nik)
                        ->orderBy('pelanggaran.created_at', 'DESC')
                        ->get();

        return view('home', compact('active', 'notif', 'nik', 'pelanggaran'));
    }
    public function DetailPelanggaranItem($id)
    {
        $active = 'dashboard';
        $notif = 'none';
        $nik = '';

        $fotos = Foto::where('pelanggaran_id', $id)->get();

        $pelanggaran_item = DB::table('pelanggaran_item')
                        ->leftJoin('pasal', 'pelanggaran_item.pasal_id', '=', 'pasal.id')
                        ->select('pelanggaran_item.id', 'pelanggaran_item.created_at', 'pelanggaran_item.denda', 'pasal.perkara', 'pasal.pasal')
                        ->where('pelanggaran_item.pelanggaran_id', $id)
                        ->get();
        

        return view('detailpelanggaranitem', compact('active', 'notif', 'nik', 'pelanggaran_item', 'fotos', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
