<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Store;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with(['store', 'address.city.country'])->paginate(15);
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        $stores = Store::all();
        $addresses = Address::with('city.country')->get();
        return view('customers.create', compact('stores', 'addresses'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'store_id' => 'required|exists:store,store_id',
            'first_name' => 'required|string|max:45',
            'last_name' => 'required|string|max:45',
            'email' => 'nullable|email|max:50',
            'address_id' => 'required|exists:address,address_id',
            'active' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Customer::create($request->all());

        return redirect()->route('customers.index')
            ->with('success', 'Cliente creado exitosamente.');
    }

    public function show(Customer $customer)
    {
        $customer->load(['store', 'address.city.country', 'rentals.film']);
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        $stores = Store::all();
        $addresses = Address::with('city.country')->get();
        return view('customers.edit', compact('customer', 'stores', 'addresses'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validator = Validator::make($request->all(), [
            'store_id' => 'required|exists:store,store_id',
            'first_name' => 'required|string|max:45',
            'last_name' => 'required|string|max:45',
            'email' => 'nullable|email|max:50',
            'address_id' => 'required|exists:address,address_id',
            'active' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $customer->update($request->all());

        return redirect()->route('customers.index')
            ->with('success', 'Cliente actualizado exitosamente');
    }

    // public function destroy(Customer $customer)
    // {
    //     try {
    //         $customer->delete();
    //         return redirect()->route('customers.index')
    //             ->with('success', 'Cliente eliminado exitosamente');
    //     } catch (\Exception $e) {
    //         return redirect()->route('customers.index')
    //             ->with('error', 'No se puede eliminar el cliente porque tiene registros relacionados');
    //     }
    // }
}