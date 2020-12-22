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

class EtilangMailController extends Mailable
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
        $ktp = Ktp::where('nik', $nik)->get()->first();
        $pelanggaran = Pelanggaran::where('nik', $nik)
                        ->where('status', 'done')
                        ->where('paid', 'tilang')
                        ->orderBy('created_at', 'DESC')
                        ->get()->first();
        
        $pelanggaran_item = DB::table('pelanggaran_item')
                        ->leftJoin('pasal', 'pelanggaran_item.pasal_id', '=', 'pasal.id')
                        ->select('pelanggaran_item.id', 'pelanggaran_item.created_at', 'pelanggaran_item.denda', 'pasal.perkara', 'pasal.pasal')
                        ->where('pelanggaran_item.pelanggaran_id', $pelanggaran->id)
                        ->get();

        $subject = "Penilangan E-Tilang";
        return $this->view('emailtilang', compact('ktp', 'pelanggaran', 'pelanggaran_item'))
                    ->subject($subject);
    }
}
