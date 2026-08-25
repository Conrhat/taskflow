<?php
namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriasController extends Controller
{
    public function index()
    {
        $categorias = Categoria::where('usuario_id', Auth::id())->get();
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        Categoria::create($request->all() + ['usuario_id' => Auth::id()]);

        return redirect()->route('categorias.index')
                         ->with('success', 'Categoría creada con éxito.');
    }

    public function show(Categoria $categoria)
    {
        abort_if($categoria->usuario_id !== Auth::id(), 403);

        return view('categorias.show', compact('categoria'));
    }

    public function edit(Categoria $categoria)
    {
        abort_if($categoria->usuario_id !== Auth::id(), 403);

        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        abort_if($categoria->usuario_id !== Auth::id(), 403);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $categoria->update($request->all());

        return redirect()->route('categorias.index')
                         ->with('success', 'Categoría actualizada con éxito.');
    }

    public function destroy(Categoria $categoria)
    {
        abort_if($categoria->usuario_id !== Auth::id(), 403);

        $categoria->delete();

        return redirect()->route('categorias.index')
                         ->with('success', 'Categoría eliminada con éxito.');
    }
}
