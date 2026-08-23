@extends('layouts.app')

@section('content')
    <div class="max-w-lg mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Nueva categoría</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">Por favor, corrige los siguientes errores:</span>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('categorias.store') }}" class="bg-white rounded-xl shadow-md p-6">
            @csrf

            <div class="mb-6">
                <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre</label>
                <input id="nombre" type="text" name="nombre" value="{{ old('nombre') }}" required autofocus
                    class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight
                           focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
            </div>

            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('categorias.index') }}"
                    class="text-gray-600 hover:text-gray-800 font-semibold py-2.5 px-4 rounded-lg transition-colors duration-200">
                    Cancelar
                </a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-4 rounded-lg transition-colors duration-200">
                    Guardar
                </button>
            </div>
        </form>
    </div>
@endsection
