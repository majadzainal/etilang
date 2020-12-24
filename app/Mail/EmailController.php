<?php

namespace App\Mail;

use App\Models\Ktp;
use App\Models\Pelanggaran;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\PelanggaranItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailController extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void 
     */
    public $nik;
    public function __construct($nikRec)
    {
        $this->nik = $nikRec;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $nik = $this->nik;
        // $pelanggaran = Pelanggaran::where('nik', $nik)
        //                 ->where('status', 'finish')
        //                 ->where('paid', 'notpaid')
        //                 ->get();

        // $pelanggaran = DB::table('pelanggaran')
        //                 ->leftJoin('pelanggaran_item', 'pelanggaran.id', '=', 'pelanggaran_item.pelanggaran_id')
        //                 ->select('pelanggaran.id', 'pelanggaran.nik', 'pelanggaran.created_at',
        //                         DB::raw('SUM(pelanggaran_item.denda) as denda'))
        //                 ->where('pelanggaran.nik', $nik)
        //                 ->where('pelanggaran.status', 'finish')
        //                 ->where('pelanggaran.paid', 'waiting')
        //                 ->groupBy('pelanggaran.id')
        //                 ->havingRaw('SUM(pelanggaran_item.denda) > ?', [2500])
        //                 ->get();

        // $pelanggaran_item = DB::table('pelanggaran_item')
        //         ->leftJoin('pelanggaran', 'pelanggaran_item.pelanggaran_id', '=', 'pelanggaran.id')
        //         ->select('pelanggaran_item.id', 'pelanggaran_item.pelanggaran_id', 'pelanggaran.nik', 'pelanggaran.created_at', 'pelanggaran_item.pasal_id',
        //                 'pelanggaran_item.denda')
        //         ->where('pelanggaran.nik', $nik)
        //         ->where('pelanggaran.status', 'finish')
        //         ->where('pelanggaran.paid', 'waiting') 
        //         ->get();
        
        $pel = Pelanggaran::where('nik', $nik)->where('status', 'finish')->where('paid', 'waiting')->get();
        foreach($pel as $pela)
        {
                //dd($pela);
                foreach($pela->PelanggaranItem as $item)
                {
                        $item->Pasal;
                }
        }
        //$pelanggaran_item = PelanggaranItem::where('pelanggaran_id', $pelanggaran->id)->get();
        
        $ktp = Ktp::where('nik', $nik)->get()->first();

        $subject = "Pelanggaran E-Tilang";

        return $this->view('email', compact('ktp', 'pel'))
                    ->subject($subject);
    }
}
