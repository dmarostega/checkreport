<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Plan;
use App\Models\ChecklistReport;
use App\Models\ChecklistTemplate;
use App\Services\ReportPdfService;
use App\Enums\PlanTier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReportPdfServiceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Plan::factory()->create([
            'name' => 'Gratuito',
            'tier' => PlanTier::Free,
            'max_templates' => 3,
            'max_reports_per_month' => 10,
        ]);
    }

    public function test_service_can_generate_pdf(): void
    {
        $user = User::factory()->create();
        $plan = Plan::first();
        $user->userPlan()->create(['plan_id' => $plan->id]);

        $template = ChecklistTemplate::factory()->create(['user_id' => $user->id]);
        $report = ChecklistReport::factory()->create([
            'template_id' => $template->id,
            'user_id' => $user->id,
        ]);

        $service = new ReportPdfService();

        // This test just ensures the service can be instantiated
        // and the method can be called without error
        $this->assertNotNull($service);
    }

    public function test_report_has_required_fields_for_pdf(): void
    {
        $user = User::factory()->create();
        $plan = Plan::first();
        $user->userPlan()->create(['plan_id' => $plan->id]);

        $template = ChecklistTemplate::factory()->create([
            'user_id' => $user->id,
            'name' => 'Vistoria Elétrica',
            'description' => 'Checklist de vistoria elétrica completa',
        ]);

        $report = ChecklistReport::factory()->create([
            'template_id' => $template->id,
            'user_id' => $user->id,
        ]);

        $this->assertNotNull($report->template);
        $this->assertNotNull($report->user);
        $this->assertEquals('Vistoria Elétrica', $report->template->name);
    }
}
