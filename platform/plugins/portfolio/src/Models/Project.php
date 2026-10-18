<?php

namespace Botble\Portfolio\Models;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends BaseModel
{
    protected $table = 'pf_projects';

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'content',
        'image',
        'images',
        'is_featured',
        'views',
        'status',
        'author',
        'place',
        'client',
        'order',
        'start_date',
        'programming_languages',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'views' => 'integer',
        'images' => 'array',
        'status' => BaseStatusEnum::class,
        'start_date' => 'date',
    ];

    public function setProgrammingLanguagesAttribute($value)
    {
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            if (is_array($decoded) && isset($decoded[0]['value'])) {
                $this->attributes['programming_languages'] = collect($decoded)->pluck('value')->implode(',');
                return;
            }
        }
        $this->attributes['programming_languages'] = is_array($value) ? implode(',', $value) : $value;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class, 'category_id');
    }

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            ProjectCategory::class,
            'pf_project_category_project',
            'project_id',
            'project_category_id'
        );
    }
}
