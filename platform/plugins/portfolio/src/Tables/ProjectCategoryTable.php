<?php

namespace Botble\Portfolio\Tables;

use Botble\Portfolio\Models\ProjectCategory;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\Actions\EditAction;
use Botble\Table\BulkActions\DeleteBulkAction;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\IdColumn;
use Botble\Table\Columns\NameColumn;
use Botble\Table\Columns\StatusColumn;
use Illuminate\Database\Eloquent\Builder;

class ProjectCategoryTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(ProjectCategory::class)
            ->addActions([
                EditAction::make()->route('portfolio.project-categories.edit'),
                DeleteAction::make()->route('portfolio.project-categories.destroy'),
            ]);
    }

    public function query(): Builder
    {
        return $this->applyScopes(
            $this->getModel()
                ->query()
                ->select([
                    'id',
                    'name',
                    'status',
                    'created_at',
                ])
        );
    }

    public function columns(): array
    {
        return [
            IdColumn::make(),
            NameColumn::make()->route('portfolio.project-categories.edit'),
            CreatedAtColumn::make(),
            StatusColumn::make(),
        ];
    }

    public function buttons(): array
    {
        return $this->addCreateButton(route('portfolio.project-categories.create'), 'portfolio.project-categories.create');
    }

    public function bulkActions(): array
    {
        return [
            DeleteBulkAction::make()->permission('portfolio.project-categories.destroy'),
        ];
    }

    public function getBulkChanges(): array
    {
        return [
            'name' => [
                'title' => trans('core/base::tables.name'),
                'type' => 'text',
                'validate' => 'required|max:120',
            ],
            'created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type' => 'datePicker',
            ],
        ];
    }
}
