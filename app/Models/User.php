<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function userPlans()
    {
        return $this->hasMany(UserPlan::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function checklistTemplates()
    {
        return $this->hasMany(ChecklistTemplate::class);
    }

    public function checklistReports()
    {
        return $this->hasMany(ChecklistReport::class);
    }

    public function getActivePlanAttribute()
    {
        $userPlan = $this->userPlans()->latest('starts_at')->first();
        if ($userPlan && $userPlan->plan) {
            return $userPlan->plan;
        }
        return Plan::where('tier', \App\Enums\PlanTier::FREE->value)->first();
    }
}
