<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait CategoryScopesTrait
{
    public function scopeByParent(Builder $query, $parentId): Builder
    {
        return $query->where('parent_id', $parentId);
    }
}