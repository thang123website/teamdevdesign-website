<?php

namespace Botble\Portfolio\Providers;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Supports\ServiceProvider;
use Botble\JsValidation\Facades\JsValidator;
use Botble\Portfolio\Http\Requests\QuoteRequest;
use Botble\Portfolio\Models\CustomField;
use Botble\Portfolio\Models\Project;
use Botble\Portfolio\Models\ProjectCategory;
use Botble\Shortcode\Compilers\Shortcode as ShortcodeCompiler;
use Botble\Shortcode\Facades\Shortcode;
use Botble\Theme\Facades\Theme;
use Illuminate\Contracts\View\View;

class HookServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->booted(function (): void {
            Shortcode::register('request-quote', __('Request quote form'), __('Request quote form'), function (ShortcodeCompiler $shortcode): View {
                Theme::asset()->container('footer')
                    ->add('js-validation', 'vendor/core/core/js-validation/js/js-validation.js', ['jquery']);
                Theme::asset()->container('footer')
                    ->writeContent('js-validation-script', JsValidator::formRequest(QuoteRequest::class), ['jquery']);

                $customFields = CustomField::query()
                    ->wherePublished()
                    ->with('options')
                    ->get();

                return view(
                    apply_filters('request-quote-shortcode', 'plugins/portfolio::shortcodes.request-quote', $shortcode, $customFields),
                    compact('shortcode', 'customFields')
                );
            });

            Shortcode::register(
                'projects-list',
                trans('plugins/portfolio::portfolio.shortcodes.projects_list.name'),
                trans('plugins/portfolio::portfolio.shortcodes.projects_list.description'),
                function (ShortcodeCompiler $shortcode): View {
                    $perPage = (int) ($shortcode->per_page ?: 9);
                    $categoryId = request()->input('category');
                    $programmingLanguage = request()->input('programming_language');
                    $search = request()->input('search');
                    $sortBy = request()->input('sort_by', $shortcode->default_sort ?: 'latest');

                    $query = Project::query()
                        ->wherePublished()
                        ->with(['categories', 'category']);

                    if ($programmingLanguage) {
                        $query->where('programming_languages', 'like', '%' . $programmingLanguage . '%');
                    }

                    if ($categoryId) {
                        $query->whereHas('categories', function ($q) use ($categoryId) {
                            $q->where('pf_project_categories.id', $categoryId);
                        });
                    }

                    if ($search) {
                        $query->where(function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%")
                                ->orWhere('description', 'like', "%{$search}%");
                        });
                    }

                    switch ($sortBy) {
                        case 'oldest':
                            $query->orderBy('created_at', 'asc');
                            break;
                        case 'name_asc':
                            $query->orderBy('name', 'asc');
                            break;
                        case 'name_desc':
                            $query->orderBy('name', 'desc');
                            break;
                        case 'featured':
                            $query->orderBy('is_featured', 'desc')->orderBy('created_at', 'desc');
                            break;
                        default: // latest
                            $query->orderBy('created_at', 'desc');
                    }

                    $projects = $query->paginate($perPage)->withQueryString();

                    $categories = ProjectCategory::query()
                        ->wherePublished()
                        ->withCount(['projects' => fn($q) => $q->wherePublished()])
                        ->orderBy('order')
                        ->get();

                    $totalProjects = Project::query()->wherePublished()->count();

                    $activeCategory = $categoryId ? ProjectCategory::find($categoryId) : null;

                    $programmingLanguages = Project::query()
                        ->wherePublished()
                        ->whereNotNull('programming_languages')
                        ->where('programming_languages', '!=', '')
                        ->pluck('programming_languages')
                        ->flatMap(function ($item) {
                            return explode(',', $item);
                        })
                        ->map(fn($item) => trim($item))
                        ->filter()
                        ->unique()
                        ->values()
                        ->all();

                    return view(
                        apply_filters('projects-list-shortcode', 'plugins/portfolio::shortcodes.projects-list', $shortcode),
                        compact('shortcode', 'projects', 'categories', 'totalProjects', 'activeCategory', 'search', 'sortBy', 'programmingLanguages', 'programmingLanguage')
                    );
                }
            );

            Shortcode::setAdminConfig('projects-list', function (array $attributes): string {
                $categories = ProjectCategory::query()
                    ->wherePublished()
                    ->orderBy('order')
                    ->pluck('name', 'id')
                    ->all();

                return view('plugins/portfolio::shortcodes.projects-list-admin', compact('attributes', 'categories'))->render();
            });
        });
    }
}
