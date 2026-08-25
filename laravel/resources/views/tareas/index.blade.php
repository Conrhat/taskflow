@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Tareas</h1>
                <p class="text-sm text-gray-500">Gestiona las tareas del equipo</p>
            </div>
            <a href="{{ route('tareas.create') }}"
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2.5 px-4 rounded-lg transition-colors duration-200">
                <span class="material-symbols-outlined text-[18px]">add</span>
                Nueva tarea
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-md overflow-hidden">

            <div class="p-4 border-b border-gray-100">
                <div class="relative sm:max-w-xs">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[19px]">search</span>
                    <input type="text" id="tareaSearch" placeholder="Buscar tarea..."
                        class="w-full h-10 rounded-lg bg-gray-50 border border-gray-200 pl-10 pr-4 text-sm text-gray-700
                               placeholder:text-gray-400 outline-none transition-all duration-200
                               focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-4 py-3">Título</th>
                            <th class="px-4 py-3">Categoría</th>
                            <th class="px-4 py-3">Estado</th>
                            <th class="px-4 py-3">Creada</th>
                            <th class="px-4 py-3 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tareaTableBody" class="divide-y divide-gray-100">
                        @forelse ($tareas as $tarea)
                            @php
                                $estadoStyles = [
                                    'pendiente' => 'bg-gray-100 text-gray-700',
                                    'en_proceso' => 'bg-amber-100 text-amber-700',
                                    'en_progreso' => 'bg-amber-100 text-amber-700',
                                    'completada' => 'bg-green-100 text-green-700',
                                ];
                                $estadoValue = $tarea->estado?->value ?? $tarea->estado;
                            @endphp
                            <tr class="tarea-row hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium text-gray-800 tarea-titulo">{{ $tarea->titulo }}</td>
                                <td class="px-4 py-3 text-gray-600 tarea-categoria">{{ $tarea->categoria?->nombre ?? '—' }}</td>
                                <td class="px-4 py-3">
                                    <form action="{{ route('tareas.estado', $tarea) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="estado" onchange="this.form.submit()"
                                            class="text-xs font-semibold rounded-full px-2.5 py-1 border-0 outline-none cursor-pointer {{ $estadoStyles[$estadoValue] ?? 'bg-gray-100 text-gray-700' }}">
                                            @foreach (\App\Enums\EstadoTarea::cases() as $opcion)
                                                <option value="{{ $opcion->value }}" @selected($estadoValue === $opcion->value)>
                                                    {{ ucfirst(str_replace('_', ' ', $opcion->value)) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td class="px-4 py-3 text-gray-500">{{ $tarea->created_at?->format('d/m/Y') }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('tareas.edit', $tarea) }}"
                                            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-blue-600 hover:bg-blue-50 transition-colors duration-200">
                                            <span class="material-symbols-outlined text-[19px]">edit</span>
                                        </a>
                                        <form action="{{ route('tareas.destroy', $tarea) }}" method="POST"
                                            onsubmit="return confirm('¿Eliminar la tarea &quot;{{ $tarea->titulo }}&quot;?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-red-600 hover:bg-red-50 transition-colors duration-200">
                                                <span class="material-symbols-outlined text-[19px]">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-gray-400">No hay tareas registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <p id="tareaNoResults" class="hidden px-4 py-8 text-center text-gray-400">
                No se encontraron tareas que coincidan con la búsqueda.
            </p>
        </div>
    </div>

    <script>
        (function () {
            const input = document.getElementById('tareaSearch');
            const rows = document.querySelectorAll('#tareaTableBody .tarea-row');
            const noResults = document.getElementById('tareaNoResults');

            input?.addEventListener('input', function () {
                const term = this.value.trim().toLowerCase();
                let visibleCount = 0;

                rows.forEach(function (row) {
                    const titulo = row.querySelector('.tarea-titulo').textContent.toLowerCase();
                    const categoria = row.querySelector('.tarea-categoria').textContent.toLowerCase();
                    const matches = titulo.includes(term) || categoria.includes(term);
                    row.classList.toggle('hidden', !matches);
                    if (matches) visibleCount++;
                });

                noResults.classList.toggle('hidden', visibleCount !== 0);
            });
        })();
    </script>
@endsection
