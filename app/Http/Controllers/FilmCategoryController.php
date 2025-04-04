<?php

namespace App\Http\Controllers;

use App\Models\FilmCategory;
use App\Models\Film;
use App\Models\Category;
use Illuminate\Http\Request;

class FilmCategoryController extends Controller
{
    public function index()
    {
        $filmCategories = FilmCategory::with(['film', 'category'])->paginate(10);
        return view('film_categories.index', compact('filmCategories'));
    }

    public function create()
    {
        $films = Film::all();
        $categories = Category::all();
        return view('film_categories.create', compact('films', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'film_id' => 'required|exists:film,film_id',
            'category_id' => 'required|exists:category,category_id',
        ]);

        FilmCategory::create($request->all());
        return redirect()->route('film-categories.index')->with('success', 'Relación película-categoría creada correctamente');
    }

    public function show($film_category)
    {
        // Separar film_id y category_id del parámetro
        [$film_id, $category_id] = explode('-', $film_category);

        // Buscar el registro
        $filmCategory = FilmCategory::where('film_id', $film_id)
            ->where('category_id', $category_id)
            ->firstOrFail();

        return view('film_categories.show', compact('filmCategory'));
    }

    public function edit($film_category)
    {
        // Separar film_id y category_id del parámetro
        [$film_id, $category_id] = explode('-', $film_category);

        // Buscar el registro
        $filmCategory = FilmCategory::where('film_id', $film_id)
            ->where('category_id', $category_id)
            ->firstOrFail();

        $films = Film::all();
        $categories = Category::all();
        return view('film_categories.edit', compact('filmCategory', 'films', 'categories'));
    }

    public function update(Request $request, $film_category)
    {
        $request->validate([
            'film_id' => 'required|exists:film,film_id',
            'category_id' => 'required|exists:category,category_id',
        ]);

        // Separar film_id y category_id del parámetro
        [$film_id, $category_id] = explode('-', $film_category);

        // Buscar el registro
        $filmCategory = FilmCategory::where('film_id', $film_id)
            ->where('category_id', $category_id)
            ->firstOrFail();

        $filmCategory->update($request->all());
        return redirect()->route('film-categories.index')->with('success', 'Relación película-categoría actualizada correctamente');
    }

    // public function destroy($film_category)
    // {
    //     // Separar film_id y category_id del parámetro
    //     [$film_id, $category_id] = explode('-', $film_category);

    //     // Buscar el registro
    //     $filmCategory = FilmCategory::where('film_id', $film_id)
    //         ->where('category_id', $category_id)
    //         ->firstOrFail();

    //     $filmCategory->delete();
    //     return redirect()->route('film-categories.index')->with('success', 'Relación película-categoría eliminada correctamente');
    // }
}