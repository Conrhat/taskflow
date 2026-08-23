<?php
namespace App\Http\Controllers;

use App\Models\Tareas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TareasController extends Controller
{
    public function index()
    {
        $tareas = Tareas::all();
        return view('tareas.index', compact('tareas'));
    }

    public function create()
    {
        return view('tareas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria_id' => 'required|exists:categoria,id',
        ]);

        Tareas::create($request->all() + ['usuario_id' => Auth::id()]);

        return redirect()->route('tareas.index')
                         ->with('success', 'Tarea creada exitosamente.');
    }

    public function edit(Tareas $tarea)
    {
        return view('tareas.edit', compact('tarea'));
    }

    public function update(Request $request, Tareas $tarea)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria_id' => 'required|exists:categoria,id',
        ]);

        $tarea->update($request->all());

        return redirect()->route('tareas.index')
                         ->with('success', 'Tarea actualizada exitosamente.');
    }

    public function destroy(Tareas $tarea)
    {
        $tarea->delete();

        return redirect()->route('tareas.index')
                         ->with('success', 'Tarea eliminada exitosamente.');
    }
}