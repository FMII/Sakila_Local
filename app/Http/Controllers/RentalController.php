<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Inventory;
use App\Models\Customer;
use App\Models\Staff;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::with(['inventory', 'customer', 'staff'])->paginate(10);
        return view('rentals.index', compact('rentals'));
    }

    public function create()
    {
        $inventories = Inventory::with('film')->get();
        $customers = Customer::all();
        $staff = Staff::all();
        return view('rentals.create', compact('inventories', 'customers', 'staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rental_date' => 'required|date',
            'inventory_id' => 'required|exists:inventory,inventory_id',
            'customer_id' => 'required|exists:customer,customer_id',
            'return_date' => 'nullable|date',
            'staff_id' => 'required|exists:staff,staff_id',
        ]);

        Rental::create($request->all());
        return redirect()->route('rentals.index')->with('success', 'Alquiler creado correctamente');
    }

    public function show(Rental $rental)
    {
        return view('rentals.show', compact('rental'));
    }

    public function edit(Rental $rental)
    {
        $inventories = Inventory::with('film')->get();
        $customers = Customer::all();
        $staff = Staff::all();
        return view('rentals.edit', compact('rental', 'inventories', 'customers', 'staff'));
    }

    public function update(Request $request, Rental $rental)
    {
        $request->validate([
            'rental_date' => 'required|date',
            'inventory_id' => 'required|exists:inventory,inventory_id',
            'customer_id' => 'required|exists:customer,customer_id',
            'return_date' => 'nullable|date',
            'staff_id' => 'required|exists:staff,staff_id',
        ]);

        $rental->update($request->all());
        return redirect()->route('rentals.index')->with('success', 'Alquiler actualizado correctamente');
    }

    public function destroy(Rental $rental)
    {
        try {
            $rental->delete();
            return redirect()->route('rentals.index')->with('success', 'Alquiler eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->route('rentals.index')->with('error', 'No se puede eliminar este alquiler porque tiene pagos asociados');
        }
    }
}