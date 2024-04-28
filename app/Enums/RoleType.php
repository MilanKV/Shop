<?php

namespace App\Enums;

enum RoleType: string
{
    case USER = 'user';
    case SUPERADMIN = 'superadmin';
    case ADMIN = 'admin';
}