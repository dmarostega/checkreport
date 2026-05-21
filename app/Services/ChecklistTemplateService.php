<?php

namespace App\Services;

use App\Models\ChecklistTemplate;
use App\Models\User;

class ChecklistTemplateService
{
    public function cloneGlobalTemplate(ChecklistTemplate $template, User $user): ChecklistTemplate
    {
        $newTemplate = $template->replicate();
        $newTemplate->user_id = $user->id;
        $newTemplate->is_global = false;
        $newTemplate->save();

        foreach ($template->sections as $section) {
            $newSection = $section->replicate();
            $newSection->checklist_template_id = $newTemplate->id;
            $newSection->save();

            foreach ($section->fields as $field) {
                $newField = $field->replicate();
                $newField->checklist_section_id = $newSection->id;
                $newField->save();
            }
        }

        return $newTemplate;
    }
}
