<?php

namespace App\Enums;

enum FieldType: string
{
    case TEXT = 'text';
    case BOOLEAN = 'boolean';
    case NUMBER = 'number';
    case SELECT = 'select';
    case PHOTO = 'photo';
    case OBSERVATION = 'observation';
}
