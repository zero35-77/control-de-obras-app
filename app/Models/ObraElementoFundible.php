<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Obra;
use App\Models\ElementoFundible;
use App\Models\Obrero;

class ObraElementoFundible extends Model
{
    protected $fillable = [
        'obra_id',
        'elemento_fundible_id',
        'fecha_hora_fundicion',
        'obrero_id',
        'numero_boleta',
        'fecha_verificacion',
        'cantidad_psi_utilizado',
        'resultado_ensayo_requerido',
        'resultado_ensayo_obtenido',
        'comentarios',
        'status',
        'semana_inicio',
        'semana_fin'
    ]; 
    public function obra()
    {
        return $this->belongsTo(Obra::class);
    }
    public function elementoFundible()
    {
        return $this->belongsTo(ElementoFundible::class);
    }
    public function obrero()
    {
        return $this->belongsTo(Obrero::class);
    }

}
