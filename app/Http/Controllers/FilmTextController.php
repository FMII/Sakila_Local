<?php

namespace App\Http\Controllers;

use App\Models\FilmText;
use App\Models\Film; // Importar el modelo Film
use Illuminate\Http\Request;

class FilmTextController extends Controller
{
    public function index()
    {
        $filmTexts = FilmText::paginate(10);
        return view('film_texts.index', compact('filmTexts'));
    }

    public function create()
    {
        // Obtener la lista de películas
        $films = Film::all();
        return view('film_texts.create', compact('films')); // Pasar $films a la vista
    }

    public function store(Request $request)
    {
        $request->validate([
            'film_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        FilmText::create($request->all());
        return redirect()->route('film_texts.index')->with('success', 'Texto de película creado correctamente');
    }

    public function show(FilmText $filmText)
    {
        return view('film_texts.show', compact('filmText'));
    }

    public function edit(FilmText $filmText)
    {
        return view('film_texts.edit', compact('filmText'));
    }

    public function update(Request $request, FilmText $filmText)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $filmText->update($request->all());
        return redirect()->route('film_texts.index')->with('success', 'Texto de película actualizado correctamente');
    }

    public function destroy(FilmText $filmText)
    {
        try {
            $filmText->delete();
            return redirect()->route('film_texts.index')->with('success', 'Texto de película eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->route('film_texts.index')->with('error', 'No se puede eliminar este texto porque tiene registros asociados');
        }
    }
}