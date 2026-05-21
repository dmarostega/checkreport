<?php

namespace App\Services;

use App\Models\ChecklistReport;
use App\Models\ChecklistAnswer;
use Illuminate\Support\Str;
use App\Enums\ReportStatus;

class ChecklistResponseService
{
    public function createReport($userId, $templateId, $customerId = null): ChecklistReport
    {
        return ChecklistReport::create([
            'user_id' => $userId,
            'customer_id' => $customerId,
            'checklist_template_id' => $templateId,
            'status' => ReportStatus::DRAFT->value,
            'token' => Str::random(32),
        ]);
    }

    public function saveAnswer(ChecklistReport $report, $fieldId, $value): ChecklistAnswer
    {
        return ChecklistAnswer::updateOrCreate(
            ['checklist_report_id' => $report->id, 'checklist_field_id' => $fieldId],
            ['value' => $value]
        );
    }
}
