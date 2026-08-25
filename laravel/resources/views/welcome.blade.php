@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto">

        <div class="mb-6 dash-fade" style="--d:0s">
            <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
            <p class="text-sm text-gray-500">Resumen general de tus tareas</p>
        </div>

        {{-- Stat cards --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <div class="dash-fade bg-white rounded-xl shadow-md p-5 hover:-translate-y-1 hover:shadow-lg transition-all duration-300" style="--d:.05s">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-blue-600 bg-blue-50 rounded-lg p-2">checklist</span>
                    <div>
                        <p class="text-2xl font-bold text-gray-800 counter" data-target="{{ $total }}">0</p>
                        <p class="text-xs text-gray-500">Total tareas</p>
                    </div>
                </div>
            </div>
            <div class="dash-fade bg-white rounded-xl shadow-md p-5 hover:-translate-y-1 hover:shadow-lg transition-all duration-300" style="--d:.1s">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-gray-600 bg-gray-100 rounded-lg p-2">hourglass_empty</span>
                    <div>
                        <p class="text-2xl font-bold text-gray-800 counter" data-target="{{ $pendientes }}">0</p>
                        <p class="text-xs text-gray-500">Pendientes</p>
                    </div>
                </div>
            </div>
            <div class="dash-fade bg-white rounded-xl shadow-md p-5 hover:-translate-y-1 hover:shadow-lg transition-all duration-300" style="--d:.15s">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-amber-600 bg-amber-50 rounded-lg p-2">autorenew</span>
                    <div>
                        <p class="text-2xl font-bold text-gray-800 counter" data-target="{{ $enProceso }}">0</p>
                        <p class="text-xs text-gray-500">En proceso</p>
                    </div>
                </div>
            </div>
            <div class="dash-fade bg-white rounded-xl shadow-md p-5 hover:-translate-y-1 hover:shadow-lg transition-all duration-300" style="--d:.2s">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-green-600 bg-green-50 rounded-lg p-2">task_alt</span>
                    <div>
                        <p class="text-2xl font-bold text-gray-800 counter" data-target="{{ $completadas }}">0</p>
                        <p class="text-xs text-gray-500">Completadas</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Progreso por estado --}}
            <div class="dash-fade md:col-span-1 bg-white rounded-xl shadow-md p-5" style="--d:.25s">
                <h2 class="text-sm font-semibold text-gray-700 mb-4">Progreso por estado</h2>

                @php
                    $barras = [
                        ['label' => 'Pendientes', 'valor' => $pendientes, 'color' => 'bg-gray-400'],
                        ['label' => 'En proceso', 'valor' => $enProceso, 'color' => 'bg-amber-500'],
                        ['label' => 'Completadas', 'valor' => $completadas, 'color' => 'bg-green-500'],
                    ];
                @endphp

                <div class="space-y-4">
                    @foreach ($barras as $b)
                        <div>
                            <div class="flex justify-between text-xs text-gray-500 mb-1">
                                <span>{{ $b['label'] }}</span>
                                <span>{{ $b['valor'] }}</span>
                            </div>
                            <div class="w-full h-2 rounded-full bg-gray-100 overflow-hidden">
                                <div class="h-full rounded-full {{ $b['color'] }} bar-fill"
                                     data-pct="{{ $total > 0 ? round($b['valor'] / $total * 100) : 0 }}"
                                     style="width:0%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-5 pt-4 border-t border-gray-100 flex items-center gap-2 text-xs text-gray-500">
                    <span class="material-symbols-outlined text-[16px]">sell</span>
                    {{ $categorias }} categoría{{ $categorias === 1 ? '' : 's' }} activa{{ $categorias === 1 ? '' : 's' }}
                </div>
            </div>

            {{-- Tareas recientes --}}
            <div class="dash-fade md:col-span-2 bg-white rounded-xl shadow-md p-5" style="--d:.3s">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-sm font-semibold text-gray-700">Tareas recientes</h2>
                    <a href="{{ route('tareas.index') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700">Ver todas</a>
                </div>

                @php
                    $estadoStyles = [
                        'pendiente' => 'bg-gray-100 text-gray-700',
                        'en_proceso' => 'bg-amber-100 text-amber-700',
                        'completada' => 'bg-green-100 text-green-700',
                    ];
                @endphp

                <ul class="divide-y divide-gray-100">
                    @forelse ($recientes as $i => $tarea)
                        @php $estadoValue = $tarea->estado?->value ?? $tarea->estado; @endphp
                        <li class="dash-fade py-3 flex items-center justify-between gap-3" style="--d:{{ .35 + $i * .05 }}s">
                            <div class="min-w-0">
                                <p class="text-sm font-medium text-gray-800 truncate">{{ $tarea->titulo }}</p>
                                <p class="text-xs text-gray-400">{{ $tarea->categoria?->nombre ?? 'Sin categoría' }}</p>
                            </div>
                            <span class="shrink-0 inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $estadoStyles[$estadoValue] ?? 'bg-gray-100 text-gray-700' }}">
                                {{ ucfirst(str_replace('_', ' ', $estadoValue ?? '—')) }}
                            </span>
                        </li>
                    @empty
                        <li class="py-8 text-center text-sm text-gray-400">Aún no hay tareas registradas.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <style>
        .dash-fade {
            opacity: 0;
            animation: dash-fade-in .5s ease-out forwards;
            animation-delay: var(--d, 0s);
        }
        @keyframes dash-fade-in {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .bar-fill {
            transition: width 1s ease-out;
        }
    </style>

    <script>
        (function () {
            document.querySelectorAll('.counter').forEach(function (el) {
                const target = parseInt(el.dataset.target, 10) || 0;
                const duration = 800;
                const start = performance.now();

                function tick(now) {
                    const progress = Math.min((now - start) / duration, 1);
                    el.textContent = Math.round(progress * target);
                    if (progress < 1) requestAnimationFrame(tick);
                }
                requestAnimationFrame(tick);
            });

            requestAnimationFrame(function () {
                document.querySelectorAll('.bar-fill').forEach(function (el) {
                    el.style.width = (el.dataset.pct || 0) + '%';
                });
            });
        })();
    </script>
@endsection
