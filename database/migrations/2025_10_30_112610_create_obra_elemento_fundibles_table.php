<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Obra;
use App\Models\ElementoFundible;
use App\Models\Obrero;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('obra_elemento_fundibles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Obra::class)->constrained();
            $table->foreignIdFor(ElementoFundible::class)->constrained()->nullable();
            $table->timestamp('fecha_hora_fundicion')->nullable();
            $table->foreignIdFor(Obrero::class)->nullable();
            $table->string('numero_boleta')->nullable();
            $table->date('fecha_verificacion')->nullable();
            $table->float('cantidad_psi_utilizado')->nullable();
            $table->float('resultado_ensayo_requerido')->nullable();
            $table->float('resultado_ensayo_obtenido')->nullable();
            $table->string('comentarios')->nullable();
            $table->enum('status', ['Realizado', 'Cancelado', 'Pendiente'])->default('Pendiente');
            $table->integer('semana_inicio')->nullable();
            $table->integer('semana_fin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obra_elemento_fundibles');
    }
};
