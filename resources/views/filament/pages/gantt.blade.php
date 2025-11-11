<x-filament-panels::page>
<div class="filament-page" style="padding:1rem;">
    <div style="display:flex; gap:1rem; align-items:center; margin-bottom:1rem;">
        <label style="font-weight:600;">Obra:</label>
        <select wire:model.live="obraId" style="padding:0.4rem 0.6rem;">
            <option value="">-- Seleccione obra --</option>
            @foreach($obras as $id => $localizacion)
                <option value="{{ $id }}">{{ $localizacion }}</option>
            @endforeach
        </select>
    </div>

    @if(empty($tasks))
        <div style="color:#6b7280;">Seleccione una obra con tareas (semana_inicio/semana_fin) para ver el diagrama Gantt.</div>
    @else
        @php
            $weekWidth = $weekWidth;
            $totalWeeks = count($weeks);
            $gridWidth = $totalWeeks * $weekWidth;
        @endphp

        <!-- header: semanas -->
        <div style="overflow-x:auto; border:1px solid #e5e7eb; padding:0.5rem; background:#fafafa;">
            <div style="display:flex; min-width:300px; gap:0; align-items:center;">
                <div style="width:260px; flex:0 0 260px; padding-right:8px; font-weight:600;">Tarea</div>
                <div style="flex:1 1 auto; position:relative;">
                    <div style="width:{{ $gridWidth }}px; display:flex;">
                        @foreach($weeks as $w)
                            <div style="width:{{ $weekWidth }}px; text-align:center; font-size:12px; color:#374151; border-left:1px solid #eee; padding:4px 2px;">
                                Semana {{ $w }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- body: tareas -->
        <div style="overflow:auto; max-height:60vh; border:1px solid #e5e7eb; margin-top:6px;">
            <div style="min-width:300px;">
                @foreach($tasks as $task)
                    @php
                        $offsetPx = $task['offset'] * $weekWidth;
                        $widthPx = max(1, $task['duration']) * $weekWidth;
                    @endphp

                    <div style="display:flex; align-items:center; gap:0; padding:8px; border-top:1px solid #f3f4f6;">
                        <div style="width:260px; flex:0 0 260px; font-size:14px; color:#111;">
                            {{ $task['label'] }}
                            <div style="font-size:12px; color:#6b7280;">S{{ $task['startWeek'] }} → S{{ $task['endWeek'] }}</div>
                        </div>
                        <div style="flex:1 1 auto; position:relative; min-height:48px;">
                            <div style="position:relative; width:{{ $gridWidth }}px; height:48px;">
                                <div style="position:absolute; left:{{ $offsetPx }}px; top:10px; height:28px; width:{{ $widthPx }}px; background:#10b981; border-radius:6px; color:white; padding:6px 8px; font-size:13px; display:flex; align-items:center;">
                                    <span style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                        Semana {{ $task['startWeek'] }} - {{ $task['endWeek'] }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
</x-filament-panels::page>
