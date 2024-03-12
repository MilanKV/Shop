<?php

namespace App\Enums;

enum RoleType: int
{
    case USER = 0;
    case SUPERADMIN = 1;
    case ADMIN = 2;
}