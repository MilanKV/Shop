<?php

namespace App\Enums;

enum UserStatus: int
{
    case ACTIVE = 0;
    case INACTIVE = 1;
}