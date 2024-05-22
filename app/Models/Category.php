<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\CategoryStatus;
use App\Models\Traits\CategoryRelationshipsTrait;
use App\Models\Traits\CategoryScopesTrait;

class Category extends Model
{
    use HasFactory, SoftDeletes, CategoryRelationshipsTrait, CategoryScopesTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_name',
        'slug',
        'short_description',
        'category_image',
        'is_parent',
        'parent_id',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => CategoryStatus::class,
    ];
}