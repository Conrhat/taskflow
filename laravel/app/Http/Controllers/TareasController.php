<?php
namespace App\Http\Controllers;

use App\Enums\EstadoTarea;
use App\Models\Tareas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class TareasController extends Controller
{
    public function index()
    {
        $tareas = Tareas::where('usuario_id', Auth::id())->get();
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
            'categoria_id' => ['required', Rule::exists('categoria', 'id')->where('usuario_id', Auth::id())],
        ]);

        Tareas::create($request->all() + ['usuario_id' => Auth::id()]);

        return redirect()->route('tareas.index')
                         ->with('success', 'Tarea creada con éxito.');
    }

    public function edit(Tareas $tarea)
    {
        abort_if($tarea->usuario_id !== Auth::id(), 403);

        return view('tareas.edit', compact('tarea'));
    }

    public function update(Request $request, Tareas $tarea)
    {
        abort_if($tarea->usuario_id !== Auth::id(), 403);

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria_id' => ['required', Rule::exists('categoria', 'id')->where('usuario_id', Auth::id())],
        ]);

        $tarea->update($request->all());

        return redirect()->route('tareas.index')
                         ->with('success', 'Tarea actualizada con éxito.');
    }

    public function updateEstado(Request $request, Tareas $tarea)
    {
        abort_if($tarea->usuario_id !== Auth::id(), 403);

        $request->validate([
            'estado' => ['required', new Enum(EstadoTarea::class)],
        ]);

        $tarea->update(['estado' => $request->estado]);

        return redirect()->route('tareas.index')
                         ->with('success', 'Estado actualizado.');
    }

    public function destroy(Tareas $tarea)
    {
        abort_if($tarea->usuario_id !== Auth::id(), 403);

        $tarea->delete();

        return redirect()->route('tareas.index')
                         ->with('success', 'Tarea eliminada con éxito.');
    }
}
