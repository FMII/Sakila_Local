<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::paginate(10);
        return view('countries.index', compact('countries'));
    }

    public function create()
    {
        return view('countries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'country' => 'required|string|max:50',
        ]);

        Country::create($request->all());
        return redirect()->route('countries.index')->with('success', 'País creado correctamente');
    }

    public function show(Country $country)
    {
        return view('countries.show', compact('country'));
    }

    public function edit(Country $country)
    {
        return view('countries.edit', compact('country'));
    }

    public function update(Request $request, Country $country)
    {
        $request->validate([
            'country' => 'required|string|max:50',
        ]);

        $country->update($request->all());
        return redirect()->route('countries.index')->with('success', 'País actualizado correctamente');
    }

    public function destroy(Country $country)
    {
        try {
            $country->delete();
            return redirect()->route('countries.index')->with('success', 'País eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->route('countries.index')->with('error', 'No se puede eliminar este país porque tiene ciudades asociadas');
        }
    }
}