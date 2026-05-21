<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = $request->user()->customers()->latest()->get();
        return inertia('Customers/Index', ['customers' => $customers]);
    }

    public function create()
    {
        return inertia('Customers/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $request->user()->customers()->create($validated);

        return redirect()->route('customers.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Customer $customer)
    {
        $this->authorize('view', $customer);
        return inertia('Customers/Edit', ['customer' => $customer]);
    }

    public function update(Request $request, Customer $customer)
    {
        $this->authorize('update', $customer);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $customer->update($validated);

        return redirect()->route('customers.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy(Customer $customer)
    {
        $this->authorize('delete', $customer);
        $customer->delete();
        
        return redirect()->route('customers.index')->with('success', 'Cliente removido com sucesso!');
    }
}
