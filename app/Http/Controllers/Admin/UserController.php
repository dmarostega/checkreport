<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = \App\Models\User::with('active_plan')->latest()->paginate(20);
        $plans = \App\Models\Plan::all();
        
        return inertia('Admin/Users/Index', [
            'users' => $users,
            'plans' => $plans
        ]);
    }

    public function update(Request $request, \App\Models\User $user)
    {
        $validated = $request->validate([
            'role' => 'required|string',
            'plan_id' => 'required|exists:plans,id',
        ]);

        $user->update(['role' => $validated['role']]);

        // Update plan
        $user->userPlans()->updateOrCreate(
            ['user_id' => $user->id],
            ['plan_id' => $validated['plan_id']]
        );

        return redirect()->back()->with('success', 'Usuário atualizado com sucesso.');
    }
}
