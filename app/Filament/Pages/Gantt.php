<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Obra;
use App\Models\ObraElementoFundible;

class Gantt extends Page
{
    protected string $view = 'filament.pages.gantt';

    public ?int $obraId = null;
    public array $obras = [];
    public array $tasks = [];
    public array $weeks = [];
    public int $weekWidth = 80;

    public function mount(): void
    {
        $this->obras = Obra::orderBy('localizacion')->pluck('localizacion', 'id')->toArray();
    }
    
    public function updatedObraId($value): void
    {
        $this->loadTasksForObra();
    }
    private function loadTasksForObra(): void
    {
        $this->tasks = [];
        $this->weeks = [];

        if (! $this->obraId) {
            return;
        }

        $obra = Obra::find($this->obraId);
        if (! $obra) {
            return;
        }

        
        $totalWeeks = (int) ($obra->cantidad_semanas ?? 0);

        $items = ObraElementoFundible::with('elementoFundible')
            ->where('obra_id', $this->obraId)
            ->get();


        $maxWeek = $totalWeeks;

        foreach ($items as $it) {
            $startWeek = is_numeric($it->semana_inicio) ? (int) $it->semana_inicio : null;
            $endWeek   = is_numeric($it->semana_fin) ? (int) $it->semana_fin : null;            
            if ($startWeek === null || $endWeek === null) {
                continue;
            }
            
            if ($endWeek < $startWeek) {
                [$startWeek, $endWeek] = [$endWeek, $startWeek];
            }
            $maxWeek = max($maxWeek, $endWeek);
            $label = $it->elementoFundible?->name ?? "Tarea #{$it->id}";
            $this->tasks[] = [
                'id' => $it->id,
                'label' => $label,
                'startWeek' => $startWeek,
                'endWeek' => $endWeek,
                'offset' => $startWeek - 1,
                'duration' => max(1, $endWeek - $startWeek + 1),
            ];
        }
        
        if ($totalWeeks <= 0) {
            $totalWeeks = max(1, $maxWeek);
        }

        $this->weeks = range(1, $totalWeeks);
    }

}
