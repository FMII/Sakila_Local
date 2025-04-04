<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Film;
use App\Models\Store;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::with(['film', 'store'])->paginate(10);
        return view('inventories.index', compact('inventories'));
    }

    public function create()
    {
        $films = Film::all();
        $stores = Store::all();
        return view('inventories.create', compact('films', 'stores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'film_id' => 'required|exists:film,film_id',
            'store_id' => 'required|exists:store,store_id',
        ]);

        Inventory::create($request->all());
        return redirect()->route('inventories.index')->with('success', 'Inventario creado correctamente');
    }

    public function show(Inventory $inventory)
    {
        return view('inventories.show', compact('inventory'));
    }

    public function edit(Inventory $inventory)
    {
        $films = Film::all();
        $stores = Store::all();
        return view('inventories.edit', compact('inventory', 'films', 'stores'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'film_id' => 'required|exists:film,film_id',
            'store_id' => 'required|exists:store,store_id',
        ]);

        $inventory->update($request->all());
        return redirect()->route('inventories.index')->with('success', 'Inventario actualizado correctamente');
    }

    // public function destroy(Inventory $inventory)
    // {
    //     try {
    //         $inventory->delete();
    //         return redirect()->route('inventories.index')->with('success', 'Inventario eliminado correctamente');
    //     } catch (\Exception $e) {
    //         return redirect()->route('inventories.index')->with('error', 'No se puede eliminar este inventario porque tiene registros asociados');
    //     }
    // }
}