<?php

namespace Botble\Portfolio\Http\Controllers;

use Botble\Base\Facades\PageTitle;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Portfolio\Forms\ProjectCategoryForm;
use Botble\Portfolio\Http\Requests\ProjectCategoryRequest;
use Botble\Portfolio\Models\ProjectCategory;
use Botble\Portfolio\Tables\ProjectCategoryTable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class ProjectCategoryController extends BaseController
{
    public function index(ProjectCategoryTable $table): View|JsonResponse
    {
        PageTitle::setTitle(trans('plugins/portfolio::portfolio.project_category.name'));

        return $table->renderTable();
    }

    public function create(): string
    {
        PageTitle::setTitle(trans('plugins/portfolio::portfolio.project_category.create'));

        return ProjectCategoryForm::create()->renderForm();
    }

    public function store(ProjectCategoryRequest $request): BaseHttpResponse
    {
        $form = ProjectCategoryForm::create();
        $form
            ->setRequest($request)
            ->save();

        return $this
            ->httpResponse()
            ->setNextUrl(route('portfolio.project-categories.edit', $form->getModel()))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    public function edit(ProjectCategory $projectCategory): string
    {
        PageTitle::setTitle(trans('core/base::forms.edit_item', ['name' => $projectCategory->name]));

        return ProjectCategoryForm::createFromModel($projectCategory)->renderForm();
    }

    public function update(ProjectCategory $projectCategory, ProjectCategoryRequest $request): BaseHttpResponse
    {
        ProjectCategoryForm::createFromModel($projectCategory)->setRequest($request)->save();

        return $this
            ->httpResponse()
            ->setNextUrl(route('portfolio.project-categories.edit', $projectCategory))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function destroy(ProjectCategory $projectCategory): DeleteResourceAction
    {
        return DeleteResourceAction::make($projectCategory);
    }
}
