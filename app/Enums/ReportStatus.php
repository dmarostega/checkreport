<?php

namespace App\Enums;

enum ReportStatus: string
{
    case DRAFT = 'draft';
    case COMPLETED = 'completed';
    case SENT = 'sent';
    case ARCHIVED = 'archived';
}
