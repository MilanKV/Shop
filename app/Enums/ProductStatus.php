<?php

namespace App\Enums;

enum ProductStatus: int
{
    case OUTOFSTOCK = 0;
    case INSTOCK = 1;
}