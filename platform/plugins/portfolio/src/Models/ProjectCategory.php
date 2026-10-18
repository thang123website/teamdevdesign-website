<?php

namespace Botble\Portfolio\Models;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectCategory extends BaseModel
{
    protected $table = 'pf_project_categories';

    protected $fillable = [
        'parent_id',
        'name',
        'description',
        'image',
        'order',
        'status',
    ];

    protected $casts = [
        'order' => 'integer',
        'status' => BaseStatusEnum::class,
    ];

    protected static function booted(): void
    {
        static::deleting(function (ProjectCategory $category): void {
            $category->children()->delete();
            $category->projects()->update(['category_id' => null]);
        });
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(ProjectCategory::class, 'parent_id');
    }

    public function projects(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            Project::class,
            'pf_project_category_project',
            'project_category_id',
            'project_id'
        );
    }
}
