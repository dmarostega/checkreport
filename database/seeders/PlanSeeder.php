<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Plan::create([
            'name' => 'Gratuito',
            'tier' => \App\Enums\PlanTier::FREE->value,
            'max_templates' => 3,
            'max_reports_per_month' => 10,
            'has_pdf' => false,
            'has_photos' => false,
        ]);

        \App\Models\Plan::create([
            'name' => 'Pro',
            'tier' => \App\Enums\PlanTier::PRO->value,
            'max_templates' => -1,
            'max_reports_per_month' => 200,
            'has_pdf' => true,
            'has_photos' => true,
        ]);

        \App\Models\Plan::create([
            'name' => 'Plus',
            'tier' => \App\Enums\PlanTier::PLUS->value,
            'max_templates' => -1,
            'max_reports_per_month' => -1,
            'has_pdf' => true,
            'has_photos' => true,
            'has_advanced_templates' => true,
            'has_custom_visuals' => true,
        ]);
    }
}
