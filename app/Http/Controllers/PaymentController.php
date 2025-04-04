<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Customer;
use App\Models\Staff;
use App\Models\Rental;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['customer', 'staff', 'rental'])->paginate(10);
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $customers = Customer::all();
        $staff = Staff::all();
        $rentals = Rental::all();
        return view('payments.create', compact('customers', 'staff', 'rentals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customer,customer_id',
            'staff_id' => 'required|exists:staff,staff_id',
            'rental_id' => 'nullable|exists:rental,rental_id',
            'amount' => 'required|numeric|min:0|max:999.99', // Añade un límite máximo
            'payment_date' => 'required|date',
        ]);

        // Formatear correctamente el valor amount
        $data = $request->all();
        $data['amount'] = number_format((float)$data['amount'], 2, '.', '');

        Payment::create($data);
        return redirect()->route('payments.index')->with('success', 'Pago creado correctamente');
    }

    public function show(Payment $payment)
    {
        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $customers = Customer::all();
        $staff = Staff::all();
        $rentals = Rental::all();
        return view('payments.edit', compact('payment', 'customers', 'staff', 'rentals'));
    }


    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'customer_id' => 'required|exists:customer,customer_id',
            'staff_id' => 'required|exists:staff,staff_id',
            'rental_id' => 'nullable|exists:rental,rental_id',
            'amount' => 'required|numeric|min:0|max:999.99', // Añade un límite máximo
            'payment_date' => 'required|date',
        ]);

        // Formatear correctamente el valor amount
        $data = $request->all();
        $data['amount'] = number_format((float)$data['amount'], 2, '.', '');

        $payment->update($data);
        return redirect()->route('payments.index')->with('success', 'Pago actualizado correctamente');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Pago eliminado correctamente');
    }
}
