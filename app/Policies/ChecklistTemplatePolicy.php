<?php

namespace App\Policies;

use App\Models\ChecklistTemplate;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ChecklistTemplatePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ChecklistTemplate $checklistTemplate): bool
    {
        return $checklistTemplate->is_global || $user->id === $checklistTemplate->user_id || $user->role === \App\Enums\UserRole::ADMIN->value;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ChecklistTemplate $checklistTemplate): bool
    {
        return $user->id === $checklistTemplate->user_id || ($checklistTemplate->is_global && $user->role === \App\Enums\UserRole::ADMIN->value);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ChecklistTemplate $checklistTemplate): bool
    {
        return $user->id === $checklistTemplate->user_id || ($checklistTemplate->is_global && $user->role === \App\Enums\UserRole::ADMIN->value);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ChecklistTemplate $checklistTemplate): bool
    {
        return $user->id === $checklistTemplate->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ChecklistTemplate $checklistTemplate): bool
    {
        return $user->id === $checklistTemplate->user_id;
    }
}
