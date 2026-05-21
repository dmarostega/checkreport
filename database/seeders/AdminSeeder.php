<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::create([
            'name' => 'Administrador',
            'email' => 'admin@checkreport.com',
            'password' => bcrypt('password'), // or Hash::make
            'role' => \App\Enums\UserRole::ADMIN->value,
        ]);
        
        $plan = \App\Models\Plan::where('tier', \App\Enums\PlanTier::PLUS->value)->first();
        if ($plan) {
            \App\Models\UserPlan::create([
                'user_id' => $user->id,
                'plan_id' => $plan->id,
                'starts_at' => now(),
            ]);
        }
    }
}
