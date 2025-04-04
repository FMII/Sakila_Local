<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Store;
use App\Models\Address;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::with(['store', 'address.city.country'])->paginate(15);
        return view('staff.index', compact('staffs'));
    }

    public function create()
    {
        $stores = Store::all();
        $roles = Role::all();
        $addresses = Address::with('city.country')->get();
        return view('staff.create', compact('stores', 'addresses','roles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:45',
            'last_name' => 'required|string|max:45',
            'address_id' => 'required|exists:address,address_id',
            'email' => 'nullable|email|max:50',
            'store_id' => 'required|exists:store,store_id',
            'active' => 'required|boolean',
            'username' => 'required|string|max:16|unique:staff',
            'password' => 'nullable|string|max:40',
            'picture' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->except('picture');

        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('staff', 'public');
            $data['picture'] = file_get_contents(storage_path('app/public/' . $picturePath));
            Storage::disk('public')->delete($picturePath);
        }

        Staff::create($data);

        return redirect()->route('staffs.index')
            ->with('success', 'Empleado creado exitosamente.');
    }

    public function show(Staff $staff)
    {
        $staff->load(['store', 'address.city.country']);
        return view('staff.show', compact('staff'));
    }

    public function edit(Staff $staff)
    {
        $stores = Store::all();
        $roles = Role::all();
        $addresses = Address::with('city.country')->get();
        return view('staff.edit', compact('staff', 'stores', 'addresses', 'roles'));
    }

    public function update(Request $request, Staff $staff)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:45',
            'last_name' => 'required|string|max:45',
            'address_id' => 'required|exists:address,address_id',
            'email' => 'nullable|email|max:50',
            'store_id' => 'required|exists:store,store_id',
            'active' => 'required|boolean',
            'username' => 'required|string|max:16|unique:staff,username,' . $staff->staff_id . ',staff_id',
            'password' => 'nullable|string|max:40',
            'picture' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->except(['picture', 'password']);

        if ($request->filled('password')) {
            $data['password'] = $request->password;
        }

        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('staff', 'public');
            $data['picture'] = file_get_contents(storage_path('app/public/' . $picturePath));
            Storage::disk('public')->delete($picturePath);
        }

        $staff->update($data);

        return redirect()->route('staffs.index')
            ->with('success', 'Empleado actualizado exitosamente');
    }

    public function destroy(Staff $staff)
    {
        try {
            $staff->delete();
            return redirect()->route('staffs.index')
                ->with('success', 'Empleado eliminado exitosamente');
        } catch (\Exception $e) {
            return redirect()->route('staffs.index')
                ->with('error', 'No se puede eliminar el empleado porque tiene registros relacionados');
        }
    }
}
