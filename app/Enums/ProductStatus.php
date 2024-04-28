<?php

namespace App\Enums;

enum ProductStatus: string
{
    case OUTOFSTOCK = 'out of stock';
    case INSTOCK = 'in stock';
}