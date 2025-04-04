<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Staff;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::with(['manager', 'address.city.country'])->paginate(15);
        return view('stores.index', compact('stores'));
    }

    public function create()
    {
        $staff = Staff::all();
        $addresses = Address::with('city.country')->get();
        return view('stores.create', compact('staff', 'addresses'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'manager_staff_id' => [
                'required',
                'exists:staff,staff_id',
                function ($attribute, $value, $fail) {
                    if (Store::where('manager_staff_id', $value)->exists()) {
                        $staff = Staff::find($value);
                        $fail("El gerente {$staff->first_name} {$staff->last_name} ya está asignado a otra tienda.");
                    }
                },
            ],
            'address_id' => 'required|exists:address,address_id',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        Store::create($request->all());
    
        return redirect()->route('stores.index')
            ->with('success', 'Tienda creada exitosamente.');
    }

    public function show(Store $store)
    {
        $store->load(['manager', 'address.city.country', 'customers', 'inventories']);
        return view('stores.show', compact('store'));
    }

    public function edit(Store $store)
    {
        $staff = Staff::all();
        $addresses = Address::with('city.country')->get();
        return view('stores.edit', compact('store', 'staff', 'addresses'));
    }

    public function update(Request $request, Store $store)
    {
        $validator = Validator::make($request->all(), [
            'manager_staff_id' => [
                'required',
                'exists:staff,staff_id',
                function ($attribute, $value, $fail) {
                    if (Store::where('manager_staff_id', $value)->exists()) {
                        $staff = Staff::find($value);
                        $fail("El gerente {$staff->first_name} {$staff->last_name} ya está asignado a otra tienda.");
                    }
                },  
            ],
            'address_id' => 'required|exists:address,address_id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $store->update($request->all());

        return redirect()->route('stores.index')
            ->with('success', 'Tienda actualizada exitosamente');
    }

    // public function destroy(Store $store)
    // {
    //     try {
    //         $store->delete();
    //         return redirect()->route('stores.index')
    //             ->with('success', 'Tienda eliminada exitosamente');
    //     } catch (\Exception $e) {
    //         return redirect()->route('stores.index')
    //             ->with('error', 'No se puede eliminar la tienda porque tiene registros relacionados');
    //     }
    // }
}