<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $plans = \App\Models\Plan::latest()->get();
        return inertia('Admin/Plans/Index', ['plans' => $plans]);
    }

    public function create()
    {
        return inertia('Admin/Plans/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tier' => 'required|string',
            'stripe_price_id' => 'nullable|string|max:255',
            'price_monthly' => 'required|numeric',
            'max_templates' => 'required|integer',
            'max_reports_per_month' => 'required|integer',
        ]);

        \App\Models\Plan::create($validated);

        return redirect()->route('admin.plans.index')->with('success', 'Plano criado com sucesso.');
    }

    public function edit(\App\Models\Plan $plan)
    {
        return inertia('Admin/Plans/Edit', ['plan' => $plan]);
    }

    public function update(Request $request, \App\Models\Plan $plan)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tier' => 'required|string',
            'stripe_price_id' => 'nullable|string|max:255',
            'price_monthly' => 'required|numeric',
            'max_templates' => 'required|integer',
            'max_reports_per_month' => 'required|integer',
        ]);

        $plan->update($validated);

        return redirect()->route('admin.plans.index')->with('success', 'Plano atualizado com sucesso.');
    }

    public function destroy(\App\Models\Plan $plan)
    {
        $plan->delete();
        return redirect()->route('admin.plans.index')->with('success', 'Plano excluído.');
    }
}
