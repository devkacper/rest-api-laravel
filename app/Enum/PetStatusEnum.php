<?php

namespace App\Enum;
enum PetStatusEnum: string
{
    case AVAILABLE = 'available';
    case PENDING = 'pending';
    case SOLD = 'sold';
}
