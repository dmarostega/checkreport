<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $plan = $user->active_plan;
        
        $totalCustomers = $user->customers()->count();
        $totalTemplates = $user->checklistTemplates()->count();
        
        $currentMonthReportsCount = $user->checklistReports()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        return inertia('Dashboard', [
            'metrics' => [
                'total_customers' => $totalCustomers,
                'total_templates' => $totalTemplates,
                'max_templates' => $plan->max_templates,
                'reports_this_month' => $currentMonthReportsCount,
                'max_reports' => $plan->max_reports_per_month,
                'plan_name' => $plan->name,
                'plan_tier' => $plan->tier,
            ]
        ]);
    }}
