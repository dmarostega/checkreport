<?php

namespace App\Services;

use App\Models\User;

class PlanLimitService
{
    public function canCreateTemplate(User $user): bool
    {
        $plan = $user->active_plan;
        
        if ($plan->max_templates === -1) {
            return true;
        }

        $currentTemplatesCount = $user->checklistTemplates()->count();
        
        return $currentTemplatesCount < $plan->max_templates;
    }

    public function canGenerateReport(User $user): bool
    {
        $plan = $user->active_plan;
        
        if ($plan->max_reports_per_month === -1) {
            return true;
        }

        $currentMonthReportsCount = $user->checklistReports()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
            
        return $currentMonthReportsCount < $plan->max_reports_per_month;
    }
}
