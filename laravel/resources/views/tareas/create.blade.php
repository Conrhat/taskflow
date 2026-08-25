@extends('layouts.app')

@section('content')
    @php
        $categorias = \App\Models\Categoria::where('usuario_id', auth()->id())->orderBy('nombre')->get();
    @endphp

    <div class="max-w-lg mx-auto">
        <div class="flex items-center gap-3 mb-6 animate-fade-in-up">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center shadow-sm">
                <span class="material-symbols-outlined text-white text-[20px]">add_task</span>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">Nueva tarea</h1>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4 animate-shake" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">Por favor, corrige los siguientes errores:</span>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('tareas.store') }}"
            class="bg-white rounded-xl shadow-md hover:shadow-lg p-6 transition-shadow duration-300 animate-fade-in-up">
            @csrf

            @php
                $estadoStyles = [
                    'pendiente' => 'bg-gray-100 text-gray-700 border-gray-200 focus:ring-gray-400/30',
                    'en_proceso' => 'bg-amber-100 text-amber-700 border-amber-200 focus:ring-amber-400/30',
                    'en_progreso' => 'bg-amber-100 text-amber-700 border-amber-200 focus:ring-amber-400/30',
                    'completada' => 'bg-green-100 text-green-700 border-green-200 focus:ring-green-400/30',
                ];
                $estadoActual = old('estado', 'pendiente');
            @endphp

            <div class="mb-5 animate-fade-in-up [animation-delay:60ms]">
                <label for="titulo" class="flex items-center gap-2 text-gray-700 text-sm font-bold mb-2">
                    <span class="material-symbols-outlined text-[18px] text-blue-500">title</span>
                    Título
                </label>
                <input id="titulo" type="text" name="titulo" value="{{ old('titulo') }}" required autofocus
                    class="shadow-sm appearance-none border border-gray-200 rounded-lg w-full py-2.5 px-3 text-gray-700 leading-tight
                           transition-all duration-200 outline-none
                           focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 hover:border-gray-300">
            </div>

            <div class="mb-5 animate-fade-in-up [animation-delay:120ms]">
                <label for="descripcion" class="flex items-center gap-2 text-gray-700 text-sm font-bold mb-2">
                    <span class="material-symbols-outlined text-[18px] text-purple-500">notes</span>
                    Descripción
                </label>
                <textarea id="descripcion" name="descripcion" rows="4"
                    class="shadow-sm appearance-none border border-gray-200 rounded-lg w-full py-2.5 px-3 text-gray-700 leading-tight
                           transition-all duration-200 outline-none
                           focus:ring-2 focus:ring-purple-500/30 focus:border-purple-500 hover:border-gray-300">{{ old('descripcion') }}</textarea>
            </div>

            <div class="mb-5 animate-fade-in-up [animation-delay:180ms]">
                <label for="categoria_id" class="flex items-center gap-2 text-gray-700 text-sm font-bold mb-2">
                    <span class="material-symbols-outlined text-[18px] text-amber-500">label</span>
                    Categoría
                </label>
                <select id="categoria_id" name="categoria_id" required
                    class="shadow-sm appearance-none border border-gray-200 rounded-lg w-full py-2.5 px-3 text-gray-700 leading-tight
                           transition-all duration-200 outline-none cursor-pointer
                           focus:ring-2 focus:ring-amber-500/30 focus:border-amber-500 hover:border-gray-300">
                    <option value="">Selecciona una categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" @selected(old('categoria_id') == $categoria->id)>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6 animate-fade-in-up [animation-delay:240ms]">
                <label for="estado" class="flex items-center gap-2 text-gray-700 text-sm font-bold mb-2">
                    <span class="material-symbols-outlined text-[18px] text-green-500">flag</span>
                    Estado
                </label>
                <select id="estado" name="estado"
                    class="appearance-none border rounded-lg w-full py-2.5 px-3 font-semibold leading-tight cursor-pointer
                           transition-all duration-200 outline-none focus:ring-2 {{ $estadoStyles[$estadoActual] ?? $estadoStyles['pendiente'] }}">
                    @foreach (\App\Enums\EstadoTarea::cases() as $estado)
                        <option value="{{ $estado->value }}" @selected($estadoActual == $estado->value)>
                            {{ ucfirst(str_replace('_', ' ', $estado->value)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center justify-end gap-3 animate-fade-in-up [animation-delay:300ms]">
                <a href="{{ route('tareas.index') }}"
                    class="text-gray-600 hover:text-gray-800 hover:bg-gray-100 font-semibold py-2.5 px-4 rounded-lg transition-all duration-200">
                    Cancelar
                </a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 active:scale-95 text-white font-semibold py-2.5 px-5 rounded-lg
                           shadow-sm hover:shadow-md transition-all duration-200">
                    Guardar
                </button>
            </div>
        </form>
    </div>

    <script>
        (function () {
            const select = document.getElementById('estado');
            if (!select) return;

            const styles = {
                pendiente: ['bg-gray-100', 'text-gray-700', 'border-gray-200', 'focus:ring-gray-400/30'],
                en_proceso: ['bg-amber-100', 'text-amber-700', 'border-amber-200', 'focus:ring-amber-400/30'],
                en_progreso: ['bg-amber-100', 'text-amber-700', 'border-amber-200', 'focus:ring-amber-400/30'],
                completada: ['bg-green-100', 'text-green-700', 'border-green-200', 'focus:ring-green-400/30'],
            };

            select.addEventListener('change', function () {
                Object.values(styles).flat().forEach((cls) => select.classList.remove(cls));
                (styles[select.value] ?? styles.pendiente).forEach((cls) => select.classList.add(cls));
            });
        })();
    </script>
@endsection
