<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Language;
use App\Models\Category;
use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $films = Film::with(['language', 'categories', 'actors'])->paginate(15);
        return view('films.index', compact('films'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = Language::all();
        $categories = Category::all();
        $actors = Actor::all();
        return view('films.create', compact('languages', 'categories', 'actors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // Convertir el array a una cadena separada por comas
        if (isset($data['special_features']) && is_array($data['special_features'])) {
            $data['special_features'] = implode(',', $data['special_features']);
        }

        $validator = Validator::make($data, [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'release_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'language_id' => 'required|exists:language,language_id',
            'original_language_id' => 'nullable|exists:language,language_id',
            'rental_duration' => 'required|integer|min:1',
            'rental_rate' => 'required|numeric|min:0|max:99.99',
            'length' => 'nullable|integer|min:1',
            'replacement_cost' => 'required|numeric|min:0|max:999.99',
            'rating' => 'nullable|string|in:G,PG,PG-13,R,NC-17',
            'special_features' => 'nullable|string',
            'categories' => 'array',
            'actors' => 'array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $film = Film::create(collect($data)->except(['categories', 'actors'])->toArray());

        if ($request->has('categories')) {
            $film->categories()->attach($request->categories);
        }

        if ($request->has('actors')) {
            $film->actors()->attach($request->actors);
        }

        return redirect()->route('films.index')
            ->with('success', 'Película creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function show(Film $film)
    {
        $film->load(['language', 'originalLanguage', 'categories', 'actors']);
        return view('films.show', compact('film'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function edit(Film $film)
    {
        $languages = Language::all();
        $categories = Category::all();
        $actors = Actor::all();
        $selectedCategories = $film->categories->pluck('category_id')->toArray();
        $selectedActors = $film->actors->pluck('actor_id')->toArray();

        return view('films.edit', compact('film', 'languages', 'categories', 'actors', 'selectedCategories', 'selectedActors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Film $film)
    {
        $data = $request->all();
        // Convertir el array a una cadena separada por comas
        if (isset($data['special_features']) && is_array($data['special_features'])) {
            $data['special_features'] = implode(',', $data['special_features']);
        }

        $validator = Validator::make($data, [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'release_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'language_id' => 'required|exists:language,language_id',
            'original_language_id' => 'nullable|exists:language,language_id',
            'rental_duration' => 'required|integer|min:1',
            'rental_rate' => 'required|numeric|min:0',
            'length' => 'nullable|integer|min:1',
            'replacement_cost' => 'required|numeric|min:0',
            'rating' => 'nullable|string|in:G,PG,PG-13,R,NC-17',
            'special_features' => 'nullable|string',
            'categories' => 'array',
            'actors' => 'array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $film = Film::create(collect($data)->except(['categories', 'actors'])->toArray());

        if ($request->has('categories')) {
            $film->categories()->sync($request->categories);
        } else {
            $film->categories()->detach();
        }

        if ($request->has('actors')) {
            $film->actors()->sync($request->actors);
        } else {
            $film->actors()->detach();
        }

        return redirect()->route('films.index')
            ->with('success', 'Película actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Film $film)
    // {
    //     try {
    //         $film->categories()->detach();
    //         $film->actors()->detach();
    //         $film->delete();
    //         return redirect()->route('films.index')
    //             ->with('success', 'Película eliminada exitosamente');
    //     } catch (\Exception $e) {
    //         return redirect()->route('films.index')
    //             ->with('error', 'No se puede eliminar la película porque tiene registros relacionados');
    //     }
    // }
}
