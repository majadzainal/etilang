<?php

namespace App\Models;

use App\Models\PelanggaranItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pasal extends Model
{
    use HasFactory;

    protected $table = "pasal";

    protected $guarded = [
        'id'
    ]; 

    public function PelanggaranItem()
    {
        return $this->hasMany(PelanggaranItem::class);
    }
}
