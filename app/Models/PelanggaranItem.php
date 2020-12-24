<?php

namespace App\Models;

use App\Models\Pasal;
use App\Models\Pelanggaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PelanggaranItem extends Model
{
    use HasFactory;

    protected $table = "pelanggaran_item";

    protected $guarded = [ 
        'id'
    ];
 
    public function Pelanggaran()
    {
        return $this->belongsTo(Pelanggaran::class);
    }

    public function Pasal()
    {
        return $this->hasOne(Pasal::class, 'id', 'pasal_id');
    }
}
