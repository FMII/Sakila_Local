<?php

namespace App\Http\Controllers;

use App\Models\FilmActor;
use App\Models\Film;
use App\Models\Actor;
use Illuminate\Http\Request;

class FilmActorController extends Controller
{
    public function index()
    {
        $filmActors = FilmActor::with(['film', 'actor'])->paginate(10);
        return view('film_actors.index', compact('filmActors'));
    }

    public function create()
    {
        $films = Film::all();
        $actors = Actor::all();
        return view('film_actors.create', compact('films', 'actors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'film_id' => 'required|exists:film,film_id',
            'actor_id' => 'required|exists:actor,actor_id',
        ]);

        FilmActor::create($request->all());
        return redirect()->route('film_actors.index')->with('success', 'Relación película-actor creada correctamente');
    }

    public function show($id)
    {
        // Parse the composite key from the route
        // Assuming format is "actor_id-film_id"
        list($actorId, $filmId) = explode('-', $id);
        
        $filmActor = FilmActor::where('actor_id', $actorId)
                            ->where('film_id', $filmId)
                            ->firstOrFail();
        
        return view('film_actors.show', compact('filmActor'));
    }

    // Similarly for edit, update, and destroy methods

    public function edit($id)
    {
        list($actorId, $filmId) = explode('-', $id);
        
        $filmActor = FilmActor::where('actor_id', $actorId)
                           ->where('film_id', $filmId)
                           ->firstOrFail();
        
        $films = Film::all();
        $actors = Actor::all();
        return view('film_actors.edit', compact('filmActor', 'films', 'actors'));
    }
    
    // public function update(Request $request, $id)
    // {
    //     list($actorId, $filmId) = explode('-', $id);
        
    //     $filmActor = FilmActor::where('actor_id', $actorId)
    //                        ->where('film_id', $filmId)
    //                        ->firstOrFail();
        
    //     $request->validate([
    //         'film_id' => 'required|exists:film,film_id',
    //         'actor_id' => 'required|exists:actor,actor_id',
    //     ]);
    
    //     $filmActor->update($request->all());
    //     return redirect()->route('film_actors.index')->with('success', 'Relación película-actor actualizada correctamente');
    // }
    
    public function destroy($id)
    {
        list($actorId, $filmId) = explode('-', $id);
        
        $filmActor = FilmActor::where('actor_id', $actorId)
                           ->where('film_id', $filmId)
                           ->firstOrFail();
        
        $filmActor->delete();
        return redirect()->route('film_actors.index')->with('success', 'Relación película-actor eliminada correctamente');
    }
}