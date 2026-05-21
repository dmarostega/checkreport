<?php

namespace App\Services;

use App\Models\ChecklistReport;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportPdfService
{
    public function generatePdf(ChecklistReport $report)
    {
        $report->load(['answers.field', 'photos', 'template', 'customer', 'user']);
        
        $pdf = Pdf::loadView('reports.pdf', compact('report'));
        
        return $pdf->download('relatorio-' . $report->id . '.pdf');
    }
}
