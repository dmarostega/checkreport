<?php

namespace App\Http\Controllers;

use App\Models\ChecklistReport;
use App\Models\ChecklistTemplate;
use App\Models\Customer;
use App\Services\ChecklistResponseService;
use App\Services\PlanLimitService;
use App\Services\ReportPdfService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChecklistReportController extends Controller
{
    public function index(Request $request)
    {
        $reports = $request->user()->checklistReports()->with(['customer', 'template'])->latest()->get();
        return inertia('Reports/Index', ['reports' => $reports]);
    }

    public function create(Request $request)
    {
        $templates = $request->user()->checklistTemplates()->get();
        $globalTemplates = ChecklistTemplate::where('is_global', true)->get();
        $customers = $request->user()->customers()->get();
        
        return inertia('Reports/Create', [
            'templates' => $templates->merge($globalTemplates),
            'customers' => $customers
        ]);
    }

    public function store(Request $request, PlanLimitService $limitService, ChecklistResponseService $responseService)
    {
        if (!$limitService->canCreateReport($request->user())) {
            return redirect()->back()->withErrors(['plan' => 'Você atingiu o limite de relatórios do seu plano atual.']);
        }

        $validated = $request->validate([
            'checklist_template_id' => 'required|exists:checklist_templates,id',
            'customer_id' => 'nullable|exists:customers,id',
        ]);

        $report = $responseService->createReport($request->user()->id, $validated['checklist_template_id'], $validated['customer_id'] ?? null);

        return redirect()->route('reports.show', $report->id);
    }

    public function show(ChecklistReport $report)
    {
        $this->authorize('view', $report);
        
        $report->load(['template.sections.fields', 'answers', 'customer', 'photos']);
        
        return inertia('Reports/Fill', ['report' => $report]);
    }

    public function saveAnswers(Request $request, ChecklistReport $report, ChecklistResponseService $responseService)
    {
        $this->authorize('update', $report);

        $answers = $request->input('answers', []);
        
        foreach ($answers as $fieldId => $value) {
            $responseService->saveAnswer($report, $fieldId, $value);
        }

        $status = $request->input('status', 'draft');
        if (in_array($status, ['draft', 'completed'])) {
            $report->update(['status' => $status]);
        }

        return redirect()->back()->with('success', 'Respostas salvas com sucesso!');
    }

    public function uploadPhoto(Request $request, ChecklistReport $report)
    {
        $this->authorize('update', $report);

        $request->validate([
            'photo' => 'required|image|max:10240', // 10MB max
            'checklist_field_id' => 'nullable|exists:checklist_fields,id'
        ]);

        $path = $request->file('photo')->store('reports/photos', 'public');

        $photo = $report->photos()->create([
            'checklist_field_id' => $request->input('checklist_field_id'),
            'file_path' => $path,
            'caption' => $request->input('caption')
        ]);

        return response()->json(['photo' => $photo]);
    }

    public function exportPdf(ChecklistReport $report, ReportPdfService $pdfService)
    {
        $this->authorize('view', $report);
        return $pdfService->generatePdf($report);
    }

    public function publicShow($token)
    {
        $report = ChecklistReport::where('token', $token)->where('status', 'completed')->firstOrFail();
        $report->load(['template.sections.fields', 'answers', 'customer', 'photos', 'user']);
        
        // Return a view (Vue public layout) for the public report.
        return inertia('Reports/PublicShow', ['report' => $report]);
    }
}
