<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Ktp;
use App\Models\Foto;
use App\Models\Logs;
use App\Models\Pasal;
use App\Models\Petugas;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;
use App\Mail\EmailController;
use App\Models\PelanggaranItem;
use Illuminate\Support\Facades\DB;
use App\Mail\EtilangMailController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class PelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active = 'pelanggaran';
        $nik = '';
        
        $notif = "none";
        return view('dashboard.pelanggaran.index', 
                    compact('active', 
                            'notif',
                            'nik'
                    ));
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
    public function store(Request $request, Pelanggaran $pelanggaran)
    {
        $validator = $request->validate([
            'nik'            => 'required'
        ]);
        
        if(!$request->pasal)
        {
            return redirect('/dashboard/pelanggaran/CariPelanggaranValidate/'.$request->nik)->with('notif', 'pasalmorethenone');
        }

        DB::beginTransaction();
        try 
        {
            $user = Auth::user();
            $petugas = Petugas::where('user_id', $user->id)->get()->first();
            $pelanggaran = Pelanggaran::create([
                'nik'             => $request->nik,
                'petugas_id'      => $petugas->id,
                'status'          => 'draft',
                'paid'            => 'waiting'
            ]);
            
            $pelanggaran_item; 

            foreach($request->get('pasal') as $key => $val)
            {
                $pasal = Pasal::find($val);
                
                $pelanggaran_item = PelanggaranItem::create([
                    'pelanggaran_id'    => $pelanggaran->id,
                    'pasal_id'          => $val,
                    'denda'             => $pasal->denda
                ]);
            }
            if ($pelanggaran && $pelanggaran_item) { DB::commit(); } else { DB::rollBack(); }
        }
        catch (Exception $e) { DB::rollBack(); }
        
        return redirect('/dashboard/pelanggaran/uploadbuktipelanggaran/'.$pelanggaran->id)->with('notif', 'pasalmorethenone');
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

    public function CariPelanggaran(Request $request)
    {
        $active = 'pelanggaran';
        $nik = $request->nik;
        $ktp = Ktp::where('nik', $nik)->get()->first();

        if(!$ktp)
        {
            $notif = "notfound";
            return view('dashboard.pelanggaran.index', 
                    compact('active', 
                            'notif',
                            'nik'
                    ));

        }

        $pasals = Pasal::get()->all();
        $pelanggarans = DB::table('pelanggaran')
                ->leftJoin('pelanggaran_item', 'pelanggaran.id', '=', 'pelanggaran_item.pelanggaran_id')
                ->select('pelanggaran.id', 'pelanggaran.nik', 'pelanggaran.created_at',
                        DB::raw('SUM(pelanggaran_item.denda) as denda'))
                ->where('pelanggaran.nik', $nik)
                ->where('pelanggaran.status', 'finish')
                ->where('pelanggaran.paid', 'waiting')
                ->groupBy('pelanggaran.id')
                ->orderBy('created_at', 'DESC')
                ->havingRaw('SUM(pelanggaran_item.denda) > ?', [2500])
                ->get();

        if(count($pelanggarans) == 3){
            return redirect('/dashboard/pelanggaran/detailpelanggaran/'.$nik);
        }

        $notif = "none";
        return view('dashboard.pelanggaran.pelanggaran', 
                    compact('pasals',
                            'active', 
                            'notif',
                            'nik',
                            'ktp',
                            'pelanggarans'
                    ));
    }
    public function CariPelanggaranValidate($nikRec)
    {
        $active = 'pelanggaran';
        $nik = $nikRec;
        $ktp = Ktp::where('nik', $nik)->get()->first();

        if(!$ktp)
        {
            $notif = "notfound";
            return view('dashboard.pelanggaran.index', 
                    compact('active', 
                            'notif',
                            'nik'
                    ));

        }

        $pasals = Pasal::get()->all();
        $pelanggarans = DB::table('pelanggaran')
                ->leftJoin('pelanggaran_item', 'pelanggaran.id', '=', 'pelanggaran_item.pelanggaran_id')
                ->select('pelanggaran.id', 'pelanggaran.nik', 'pelanggaran.created_at',
                        DB::raw('SUM(pelanggaran_item.denda) as denda'))
                ->where('pelanggaran.nik', $nik)
                ->where('pelanggaran.status', 'finish')
                ->where('pelanggaran.paid', 'waiting')
                ->groupBy('pelanggaran.id')
                ->orderBy('created_at', 'DESC')
                ->havingRaw('SUM(pelanggaran_item.denda) > ?', [2500])
                ->get();

        $notif = "pasalmorethenone";
        return view('dashboard.pelanggaran.pelanggaran', 
                    compact('pasals',
                            'active', 
                            'notif',
                            'nik',
                            'ktp',
                            'pelanggarans'
                    ));
    }

    public function UploadBuktiPelanggaran($pelanggaran_id)
    {
        $active = 'pelanggaran';
        $notif = 'none';
        $pelanggaran_item = DB::table('pelanggaran_item')
                        ->leftJoin('pasal', 'pelanggaran_item.pasal_id', '=', 'pasal.id')
                        ->select('pasal.perkara', 'pasal.pasal', 'pasal.denda', 
                                'pelanggaran_item.created_at', 'pelanggaran_item.id')
                        ->where('pelanggaran_id', $pelanggaran_id)
                        ->get()->all();


        return view('dashboard.pelanggaran.uploadbukti', 
                    compact('active', 
                            'notif',
                            'pelanggaran_item', 
                            'pelanggaran_id'
                    ));
    }

    public function UploadBuktiPelanggaranNotif($pelanggaran_id, $notif)
    {
        $active = 'pelanggaran';
        $notif = $notif;
        $pelanggaran_item = PelanggaranItem::where('pelanggaran_id', $pelanggaran_id)->get()->all();


        return view('dashboard.pelanggaran.uploadbukti', 
                    compact('active', 
                            'notif',
                            'pelanggaran_item', 
                            'pelanggaran_id'
                    ));
    }

    public function UploadBuktiPelanggaranstore(Request $request)
    {
        $pelanggaran = Pelanggaran::find($request->pelanggaran_id);
        $input = $request->all();
        $images = array();


        if($files=$request->file('foto'))
        {
            DB::beginTransaction();
            try 
            {
                $number = 1;
                foreach($files as $file)
                {
                    $name = $pelanggaran->nik.'-'.time().'-000'.$number.'.'.$file->extension(); 
                    $file->move('upload',$name);
                    $images[]=$name;

                    $foto = Foto::create([
                        'pelanggaran_id'    => $pelanggaran->id,
                        'name'              => $name
                    ]);


                    $number++;
                }
                if ($foto) { DB::commit(); } else { DB::rollBack(); }

                return redirect('/dashboard/pelanggaran/finishpelanggaran/'.$pelanggaran->id);
            }
            catch (Exception $e) { DB::rollBack(); }

            return redirect('/dashboard/pelanggaran/finishpelanggaran/'.$pelanggaran->id);
        }
        else
        {
            return redirect('/dashboard/pelanggaran/UploadBuktiPelanggaranNotif/'.$pelanggaran->id.'/pilihfoto');
        }
        

    }

    public function FinishPelanggaran($id)
    {
        $active = 'pelanggaran';
        $notif = 'none';
        $pelanggaran_id = $id;
        $pelanggaranData = Pelanggaran::find($id);
        $pelanggaran = DB::table('pelanggaran')
                ->leftJoin('pelanggaran_item', 'pelanggaran.id', '=', 'pelanggaran_item.pelanggaran_id')
                ->select('pelanggaran.id', 'pelanggaran.nik', 'pelanggaran.created_at',
                        DB::raw('SUM(pelanggaran_item.denda) as denda'))
                ->where('pelanggaran.nik', $pelanggaranData->nik)
                ->where('pelanggaran.status', 'finish')
                ->where('pelanggaran.paid', 'waiting')
                ->groupBy('pelanggaran.id')
                ->havingRaw('SUM(pelanggaran_item.denda) > ?', [2500])
                ->orderBy('created_at', 'DESC')
                ->get();

        return view('dashboard.pelanggaran.finish', 
                    compact('active', 
                            'notif',
                            'pelanggaran', 
                            'pelanggaran_id'
                    ));
    }

    public function FinishPelanggaranStore(Request $request)
    {
        $pelanggaran = Pelanggaran::find($request->pelanggaran_id);
        $pelanggaran->update([
            'status'            => 'finish'
        ]);
        
        $ktp = Ktp::where('nik', $pelanggaran->nik)->get()->first();

        $description = 'Membuat pelanggaran peringatan dengan NIK '.$ktp->nik.'('.$ktp->nama.')';
        $user = Auth::user();
        $logs = Logs::create([
            'user_id'          => $user->id,
            'description'      => $description
        ]);

        Mail::to($ktp->email)->send(new EmailController($pelanggaran->nik));

        return redirect('/dashboard/pelanggaran/detailpelanggaran/'.$pelanggaran->nik);
    }

    public function DetailPelanggaran($nik)
    {
        $active = 'pelanggaran';
        $notif = 'none';
        $tilang = false;

        $pelanggaran = DB::table('pelanggaran')
                ->leftJoin('pelanggaran_item', 'pelanggaran.id', '=', 'pelanggaran_item.pelanggaran_id')
                ->select('pelanggaran.id', 'pelanggaran.nik', 'pelanggaran.created_at',
                        DB::raw('SUM(pelanggaran_item.denda) as denda'))
                ->where('pelanggaran.nik', $nik)
                ->where('pelanggaran.status', 'finish')
                ->where('pelanggaran.paid', 'waiting')
                ->groupBy('pelanggaran.id')
                ->havingRaw('SUM(pelanggaran_item.denda) > ?', [2500])
                ->orderBy('created_at', 'DESC')
                ->get();

        if(count($pelanggaran) == 3){$tilang = true;}

        return view('dashboard.pelanggaran.detailtotilang', 
                compact('active', 
                        'notif',
                        'nik',
                        'pelanggaran',
                        'tilang'
                ));
    }

    public function TilangPelanggar(Request $request)
    {
        $validator = $request->validate([
            'nik'            => 'required'
        ]);
        
        $nik = $request->nik;
        $pelanggarans = Pelanggaran::where('nik', $nik)
                        ->where('status', 'finish')
                        ->where('paid', 'waiting')
                        ->update(['status' => 'done']);

        $pelanggaran = Pelanggaran::where('nik', $nik)
                        ->where('status', 'done')
                        ->where('paid', 'waiting')
                        ->orderBy('created_at', 'DESC')
                        ->get()->first();

        $pelanggaran->update([
            'paid'            => 'tilang'
        ]);
        
        $pelanggaran_item = DB::table('pelanggaran_item')
                    ->leftJoin('pasal', 'pelanggaran_item.pasal_id', '=', 'pasal.id')
                    ->select('pelanggaran_item.id', 'pelanggaran_item.created_at', 'pelanggaran_item.denda', 'pasal.perkara', 'pasal.pasal')
                    ->where('pelanggaran_item.pelanggaran_id', $pelanggaran->id)
                    ->get();

        $ktp = Ktp::where('nik', $nik)->get()->first();

        $description = 'Membuat penilangan dengan NIK '.$ktp->nik.'('.$ktp->nama.')';
        $user = Auth::user();
        $logs = Logs::create([
            'user_id'          => $user->id,
            'description'      => $description
        ]);

        Mail::to($ktp->email)->send(new EtilangMailController($nik));
        
        return redirect('/dashboard/pelanggaran/successtilang/'.$nik.'/'.$pelanggaran->id);
    }

    public function SuccessTilang($nik, $pelanggaran_id)
    {
        $active = 'pelanggaran';
        $notif = 'none';
        $ktp = Ktp::where('nik', $nik)->get()->first();

        $pelanggaran = Pelanggaran::find($pelanggaran_id);
        $pelanggaran_item = DB::table('pelanggaran_item')
                        ->leftJoin('pasal', 'pelanggaran_item.pasal_id', '=', 'pasal.id')
                        ->select('pelanggaran_item.id', 'pelanggaran_item.created_at', 'pelanggaran_item.denda', 'pasal.perkara', 'pasal.pasal')
                        ->where('pelanggaran_item.pelanggaran_id', $pelanggaran_id)
                        ->get();


        return view('dashboard.pelanggaran.successtilang', 
                compact('active', 
                        'notif',
                        'ktp',
                        'pelanggaran',
                        'pelanggaran_item'
                ));
    }
}
