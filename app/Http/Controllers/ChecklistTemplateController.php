<?php

namespace App\Http\Controllers;

use App\Models\ChecklistTemplate;
use Illuminate\Http\Request;

class ChecklistTemplateController extends Controller
{
    public function index(Request $request)
    {
        $templates = $request->user()->checklistTemplates()->withCount('sections')->latest()->get();
        return inertia('Templates/Index', ['templates' => $templates]);
    }

    public function create()
    {
        return inertia('Templates/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:20',
        ]);

        $request->user()->checklistTemplates()->create($validated);

        return redirect()->route('templates.index')->with('success', 'Modelo criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(ChecklistTemplate $template)
    {
        $this->authorize('update', $template);
        $template->load('sections.fields');
        return inertia('Templates/Edit', ['template' => $template]);
    }

    public function update(Request $request, ChecklistTemplate $template)
    {
        $this->authorize('update', $template);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:20',
        ]);

        $template->update($validated);

        return redirect()->route('templates.index')->with('success', 'Modelo atualizado com sucesso!');
    }

    public function destroy(ChecklistTemplate $template)
    {
        $this->authorize('delete', $template);
        $template->delete();
        
        return redirect()->route('templates.index')->with('success', 'Modelo removido com sucesso!');
    }

    public function updateStructure(Request $request, ChecklistTemplate $template)
    {
        $this->authorize('update', $template);

        $validated = $request->validate([
            'sections' => 'array',
            'sections.*.id' => 'nullable|integer',
            'sections.*.title' => 'required|string|max:255',
            'sections.*.order' => 'required|integer',
            'sections.*.fields' => 'array',
            'sections.*.fields.*.id' => 'nullable|integer',
            'sections.*.fields.*.type' => 'required|string',
            'sections.*.fields.*.label' => 'required|string|max:255',
            'sections.*.fields.*.options' => 'nullable|array',
            'sections.*.fields.*.is_required' => 'required|boolean',
            'sections.*.fields.*.order' => 'required|integer',
        ]);

        \DB::transaction(function () use ($template, $validated) {
            // Get existing section IDs to detect deletions
            $existingSectionIds = $template->sections()->pluck('id')->toArray();
            $keptSectionIds = [];

            foreach ($validated['sections'] as $sectionData) {
                $section = $template->sections()->updateOrCreate(
                    ['id' => $sectionData['id'] ?? null],
                    ['title' => $sectionData['title'], 'order' => $sectionData['order']]
                );
                
                $keptSectionIds[] = $section->id;
                
                $existingFieldIds = $section->fields()->pluck('id')->toArray();
                $keptFieldIds = [];

                if (isset($sectionData['fields'])) {
                    foreach ($sectionData['fields'] as $fieldData) {
                        $field = $section->fields()->updateOrCreate(
                            ['id' => $fieldData['id'] ?? null],
                            [
                                'type' => $fieldData['type'],
                                'label' => $fieldData['label'],
                                'options' => $fieldData['options'],
                                'is_required' => $fieldData['is_required'],
                                'order' => $fieldData['order'],
                            ]
                        );
                        $keptFieldIds[] = $field->id;
                    }
                }
                
                // Delete removed fields
                $fieldsToDelete = array_diff($existingFieldIds, $keptFieldIds);
                if (!empty($fieldsToDelete)) {
                    $section->fields()->whereIn('id', $fieldsToDelete)->delete();
                }
            }

            // Delete removed sections
            $sectionsToDelete = array_diff($existingSectionIds, $keptSectionIds);
            if (!empty($sectionsToDelete)) {
                $template->sections()->whereIn('id', $sectionsToDelete)->delete();
            }
        });

        return redirect()->back()->with('success', 'Estrutura do modelo salva com sucesso!');
    }
}
