<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório #{{ str_pad($report->id, 6, '0', STR_PAD_LEFT) }}</title>
    <style>
        body { font-family: Helvetica, Arial, sans-serif; font-size: 12px; color: #333; }
        .header { background-color: #f8fafc; padding: 20px; border-bottom: 2px solid #e2e8f0; margin-bottom: 20px; }
        .title { font-size: 24px; font-weight: bold; margin: 0 0 5px 0; color: #0f172a; }
        .subtitle { font-size: 12px; color: #64748b; margin: 0 0 15px 0; }
        .info-grid { width: 100%; border-collapse: collapse; }
        .info-grid td { padding: 5px 0; width: 50%; }
        .label { font-weight: bold; color: #475569; text-transform: uppercase; font-size: 10px; }
        .value { font-size: 14px; font-weight: bold; color: #0f172a; }
        .section { margin-top: 20px; page-break-inside: avoid; }
        .section-title { font-size: 16px; font-weight: bold; border-bottom: 1px solid #cbd5e1; padding-bottom: 5px; margin-bottom: 15px; color: #1e293b; }
        .field { margin-bottom: 15px; background-color: #f8fafc; padding: 10px; border: 1px solid #e2e8f0; border-radius: 4px; }
        .field-label { font-weight: bold; font-size: 12px; color: #475569; display: block; margin-bottom: 5px; }
        .field-value { font-size: 14px; color: #0f172a; white-space: pre-wrap; }
        .photos { margin-top: 10px; }
        .photo-wrapper { display: inline-block; margin-right: 10px; margin-bottom: 10px; width: 200px; height: 200px; }
        .photo-wrapper img { width: 100%; height: 100%; object-fit: cover; border: 1px solid #ccc; border-radius: 4px; }
        .footer { position: fixed; bottom: -30px; left: 0; right: 0; text-align: center; font-size: 10px; color: #94a3b8; }
    </style>
</head>
<body>
    <div class="footer">Gerado por CheckLaudo - Responsabilidade Técnica Exclusiva de {{ $report->user->name }}</div>

    <div class="header">
        <h1 class="title">{{ $report->template->name }}</h1>
        <p class="subtitle">ID do Laudo: #{{ str_pad($report->id, 6, '0', STR_PAD_LEFT) }}</p>

        <table class="info-grid">
            <tr>
                <td>
                    <div class="label">Cliente / Local</div>
                    <div class="value">{{ $report->customer ? $report->customer->name : 'N/A' }}</div>
                </td>
                <td>
                    <div class="label">Responsável Técnico</div>
                    <div class="value">{{ $report->user->name }}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="label">Data de Emissão</div>
                    <div class="value">{{ $report->created_at->format('d/m/Y H:i') }}</div>
                </td>
                <td>
                    <div class="label">Status</div>
                    <div class="value">{{ $report->status === 'completed' ? 'Concluído' : 'Rascunho' }}</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="content">
        @foreach($report->template->sections as $section)
            <div class="section">
                <div class="section-title">{{ $section->title }}</div>
                
                @foreach($section->fields as $field)
                    <div class="field">
                        <span class="field-label">{{ $field->label }}</span>
                        
                        @if($field->type === 'photo')
                            <div class="photos">
                                @php
                                    $photos = $report->photos->where('checklist_field_id', $field->id);
                                @endphp
                                @if($photos->count() > 0)
                                    @foreach($photos as $photo)
                                        <div class="photo-wrapper">
                                            <img src="{{ storage_path('app/public/' . $photo->file_path) }}" alt="Foto">
                                        </div>
                                    @endforeach
                                @else
                                    <div class="field-value" style="color:#94a3b8; font-style:italic;">Nenhuma foto anexada.</div>
                                @endif
                            </div>
                        @else
                            @php
                                $answer = $report->answers->where('checklist_field_id', $field->id)->first();
                            @endphp
                            <div class="field-value">{{ $answer ? $answer->value : '-' }}</div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</body>
</html>
