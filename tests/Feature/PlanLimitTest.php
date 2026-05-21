<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Plan;
use App\Models\ChecklistTemplate;
use App\Services\PlanLimitService;
use App\Enums\PlanTier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlanLimitTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create plans
        Plan::factory()->create([
            'name' => 'Gratuito',
            'tier' => PlanTier::Free,
            'max_templates' => 3,
            'max_reports_per_month' => 10,
        ]);

        Plan::factory()->create([
            'name' => 'Pro',
            'tier' => PlanTier::Pro,
            'max_templates' => null,
            'max_reports_per_month' => 200,
        ]);
    }

    public function test_free_plan_user_can_create_up_to_three_templates(): void
    {
        $freePlan = Plan::where('tier', PlanTier::Free)->first();
        $user = User::factory()->create();
        $user->userPlan()->create(['plan_id' => $freePlan->id]);

        $limitService = new PlanLimitService($user);

        // Create 3 templates - should succeed
        for ($i = 0; $i < 3; $i++) {
            ChecklistTemplate::create([
                'user_id' => $user->id,
                'name' => "Template {$i}",
                'description' => "Test template {$i}",
            ]);
        }

        $canCreate = $limitService->canCreateTemplate();
        $this->assertFalse($canCreate, 'Free plan user should not be able to create more than 3 templates');
    }

    public function test_pro_plan_user_can_create_unlimited_templates(): void
    {
        $proPlan = Plan::where('tier', PlanTier::Pro)->first();
        $user = User::factory()->create();
        $user->userPlan()->create(['plan_id' => $proPlan->id]);

        $limitService = new PlanLimitService($user);

        // Create many templates
        for ($i = 0; $i < 10; $i++) {
            ChecklistTemplate::create([
                'user_id' => $user->id,
                'name' => "Template {$i}",
                'description' => "Test template {$i}",
            ]);
        }

        $canCreate = $limitService->canCreateTemplate();
        $this->assertTrue($canCreate, 'Pro plan user should be able to create unlimited templates');
    }

    public function test_limit_service_correctly_identifies_plan(): void
    {
        $freePlan = Plan::where('tier', PlanTier::Free)->first();
        $user = User::factory()->create();
        $user->userPlan()->create(['plan_id' => $freePlan->id]);

        $limitService = new PlanLimitService($user);

        $this->assertTrue($limitService->isFreeUser(), 'Should identify as free user');
        $this->assertFalse($limitService->isProUser(), 'Should not identify as pro user');
    }
}
