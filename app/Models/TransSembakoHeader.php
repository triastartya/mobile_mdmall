<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransSembakoHeader extends Model
{
    //
    protected $table = 'transsembakoheader';
    public $timestamps = false;

    function TransSembakoDetailBarang(){
        return $this->hasMany(TransSembakoDetailBarang::class,'TransSembakoID','TransSembakoID');
    }
}
