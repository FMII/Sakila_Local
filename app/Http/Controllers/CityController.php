<?php
namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::with('country')->paginate(10);
        return view('cities.index', compact('cities'));
    }

    public function create()
    {
        $countries = Country::all();
        return view('cities.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'city' => 'required|string|max:50',
            'country_id' => 'required|exists:country,country_id',
        ]);

        City::create($request->all());
        return redirect()->route('cities.index')->with('success', 'Ciudad creada correctamente');
    }

    public function show(City $city)
    {
        return view('cities.show', compact('city'));
    }

    public function edit(City $city)
    {
        $countries = Country::all();
        return view('cities.edit', compact('city', 'countries'));
    }

    public function update(Request $request, City $city)
    {
        $request->validate([
            'city' => 'required|string|max:50',
            'country_id' => 'required|exists:country,country_id',
        ]);

        $city->update($request->all());
        return redirect()->route('cities.index')->with('success', 'Ciudad actualizada correctamente');
    }

    public function destroy(City $city)
    {
        try {
            $city->delete();
            return redirect()->route('cities.index')->with('success', 'Ciudad eliminada correctamente');
        } catch (\Exception $e) {
            return redirect()->route('cities.index')->with('error', 'No se puede eliminar esta ciudad porque tiene registros asociados');
        }
    }
}