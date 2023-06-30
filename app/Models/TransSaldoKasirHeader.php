<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransSaldoKasirHeader extends Model
{
    //
    protected $table = 'transsaldokasirheader';
    public $timestamps = false;

    function Lokasi(){
        return $this->hasOne(Lokasi::class,"IdLokasi","IdLokasi");
    }
    
    function TransSaldoKasirDetailRekapSistem(){
        return $this->hasMany(TransSaldoKasirDetailRekapSistem::class,'TransID','TransID');
    }

    function TransSaldoKasirDetailTambahanModal(){
        return $this->hasMany(TransSaldoKasirDetailTambahanModal::class,'TransID','TransID');
    }
}
