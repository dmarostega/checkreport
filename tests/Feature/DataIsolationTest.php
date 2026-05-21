<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Plan;
use App\Models\Customer;
use App\Models\ChecklistTemplate;
use App\Enums\PlanTier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DataIsolationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a plan
        Plan::factory()->create([
            'name' => 'Gratuito',
            'tier' => PlanTier::Free,
            'max_templates' => 3,
            'max_reports_per_month' => 10,
        ]);
    }

    public function test_user_cannot_view_other_users_customers(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        
        $plan = Plan::first();
        $user1->userPlan()->create(['plan_id' => $plan->id]);
        $user2->userPlan()->create(['plan_id' => $plan->id]);

        $customer1 = Customer::factory()->create(['user_id' => $user1->id]);
        $customer2 = Customer::factory()->create(['user_id' => $user2->id]);

        // User1 should see only their customer
        $this->actingAs($user1);
        
        $response = $this->get(route('customers.show', $customer1->id));
        $this->assertEquals(200, $response->status());

        // User1 should not be able to access User2's customer
        $response = $this->get(route('customers.show', $customer2->id));
        $this->assertEquals(403, $response->status());
    }

    public function test_user_cannot_view_other_users_templates(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        
        $plan = Plan::first();
        $user1->userPlan()->create(['plan_id' => $plan->id]);
        $user2->userPlan()->create(['plan_id' => $plan->id]);

        $template1 = ChecklistTemplate::factory()->create(['user_id' => $user1->id]);
        $template2 = ChecklistTemplate::factory()->create(['user_id' => $user2->id]);

        $this->actingAs($user1);
        
        // User1 should see their own template
        $response = $this->get(route('templates.show', $template1->id));
        $this->assertEquals(200, $response->status());

        // User1 should not see User2's template
        $response = $this->get(route('templates.show', $template2->id));
        $this->assertEquals(403, $response->status());
    }

    public function test_users_can_only_list_their_own_customers(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        
        $plan = Plan::first();
        $user1->userPlan()->create(['plan_id' => $plan->id]);
        $user2->userPlan()->create(['plan_id' => $plan->id]);

        Customer::factory(3)->create(['user_id' => $user1->id]);
        Customer::factory(2)->create(['user_id' => $user2->id]);

        $this->actingAs($user1);
        
        $response = $this->get(route('customers.index'));
        $response->assertViewHas('customers');
        
        $customers = $response->viewData('customers');
        
        // Should only show user1's customers
        foreach ($customers as $customer) {
            $this->assertEquals($user1->id, $customer->user_id);
        }
    }
}
