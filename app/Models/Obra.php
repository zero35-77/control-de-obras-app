<?php

namespace App\Models;
use App\Models\EncargadoObra;
use Illuminate\Database\Eloquent\Model;
use App\Models\ObraElementoFundible;

class Obra extends Model
{
    protected $fillable = ['codigo', 'localizacion', 'encargado_obra_id'];
    public function encargadoObra()
    {
        return $this->belongsTo(EncargadoObra::class);
    }
    public function obraElementoFundibles()
    {
        return $this->hasMany(ObraElementoFundible::class);
    }
}
