@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Categorías</h1>
                <p class="text-sm text-gray-500">Gestiona las categorías de tareas</p>
            </div>
            <a href="{{ route('categorias.create') }}"
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2.5 px-4 rounded-lg transition-colors duration-200">
                <span class="material-symbols-outlined text-[18px]">add</span>
                Nueva categoría
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
                    <input type="text" id="categoriaSearch" placeholder="Buscar categoría..."
                        class="w-full h-10 rounded-lg bg-gray-50 border border-gray-200 pl-10 pr-4 text-sm text-gray-700
                               placeholder:text-gray-400 outline-none transition-all duration-200
                               focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                </div>
            </div>

            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-500 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-4 py-3">Nombre</th>
                        <th class="px-4 py-3">Creada</th>
                        <th class="px-4 py-3 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody id="categoriaTableBody" class="divide-y divide-gray-100">
                    @forelse ($categorias as $categoria)
                        <tr class="categoria-row hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium text-gray-800 categoria-nombre">{{ $categoria->nombre }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $categoria->created_at?->format('d/m/Y') }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('categorias.edit', $categoria) }}"
                                        class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-blue-600 hover:bg-blue-50 transition-colors duration-200">
                                        <span class="material-symbols-outlined text-[19px]">edit</span>
                                    </a>
                                    <form action="{{ route('categorias.destroy', $categoria) }}" method="POST"
                                        onsubmit="return confirm('¿Eliminar la categoría &quot;{{ $categoria->nombre }}&quot;?');">
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
                            <td colspan="3" class="px-4 py-8 text-center text-gray-400">No hay categorías registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <p id="categoriaNoResults" class="hidden px-4 py-8 text-center text-gray-400">
                No se encontraron categorías que coincidan con la búsqueda.
            </p>
        </div>
    </div>

    <script>
        (function () {
            const input = document.getElementById('categoriaSearch');
            const rows = document.querySelectorAll('#categoriaTableBody .categoria-row');
            const noResults = document.getElementById('categoriaNoResults');

            input?.addEventListener('input', function () {
                const term = this.value.trim().toLowerCase();
                let visibleCount = 0;

                rows.forEach(function (row) {
                    const nombre = row.querySelector('.categoria-nombre').textContent.toLowerCase();
                    const matches = nombre.includes(term);
                    row.classList.toggle('hidden', !matches);
                    if (matches) visibleCount++;
                });

                noResults.classList.toggle('hidden', visibleCount !== 0);
            });
        })();
    </script>
@endsection
