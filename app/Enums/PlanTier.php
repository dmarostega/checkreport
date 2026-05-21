<?php

namespace App\Enums;

enum PlanTier: string
{
    case FREE = 'free';
    case PRO = 'pro';
    case PLUS = 'plus';
}
