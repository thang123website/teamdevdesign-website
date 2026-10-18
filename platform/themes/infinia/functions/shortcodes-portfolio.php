<?php

use Botble\Base\Forms\FieldOptions\ColorFieldOption;
use Botble\Base\Forms\FieldOptions\DescriptionFieldOption;
use Botble\Base\Forms\FieldOptions\MediaImageFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\TextareaFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\FieldOptions\UiSelectorFieldOption;
use Botble\Base\Forms\Fields\ColorField;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\Fields\UiSelectorField;
use Botble\Portfolio\Models\Package;
use Botble\Portfolio\Models\Project;
use Botble\Portfolio\Models\Service;
use Botble\Shortcode\Compilers\Shortcode as ShortcodeCompiler;
use Botble\Shortcode\Facades\Shortcode;
use Botble\Shortcode\Forms\FieldOptions\ShortcodeTabsFieldOption;
use Botble\Shortcode\Forms\Fields\ShortcodeTabsField;
use Botble\Shortcode\ShortcodeField;
use Botble\Theme\Facades\Theme;
use Illuminate\Support\Arr;
use Theme\Infinia\Forms\ShortcodeForm;

app()->booted(function (): void {
    if (! is_plugin_active('portfolio')) {
        return;
    }

    Shortcode::register('projects', __('Projects'), __('Projects'), function (ShortcodeCompiler $shortcode) {
        $projectIds = Shortcode::fields()->getIds('project_ids', $shortcode);
        $tabs = Shortcode::fields()->getTabsData(['title', 'description'], $shortcode);

        $limit = $shortcode->limit ?: null;

        $projects = Project::query()
            ->when($projectIds, fn ($query) => $query->whereIn('id', $projectIds))
            ->when($limit, fn ($query) => $query->limit($limit))
            ->wherePublished()
            ->with(['slugable', 'metadata'])
            ->when((! $limit && ! $projectIds), fn ($query) => $query->paginate(9), fn ($query) => $query->get());

        if ($projects->isEmpty()) {
            return null;
        }

        return Theme::partial('shortcodes.projects.index', compact('shortcode', 'projects', 'tabs'));
    });

    Shortcode::setPreviewImage('projects', Theme::asset()->url('images/ui-blocks/projects.png'));

    Shortcode::setAdminConfig('projects', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'style',
                UiSelectorField::class,
                UiSelectorFieldOption::make()
                    ->label(__('Style'))
                    ->defaultValue($attributes['style'] ?? 1)
                    ->numberItemsPerRow(1)
                    ->withoutAspectRatio()
                    ->choices(
                        collect(range(1, 3))->mapWithKeys(function ($i) {
                            return [
                                $i => [
                                    'label' => __('Style :i', ['i' => $i]),
                                    'image' => Theme::asset()->url("images/shortcodes/projects/style-$i.png"),
                                ],
                            ];
                        })->all()
                    )
            )
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title'))
            )
            ->add(
                'subtitle',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Subtitle'))
            )
            ->add(
                'description',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label(__('Description'))
                    ->rows(2)
            )
            ->addOpenFieldset('data_count_open', [
                'data-bb-collapse' => 'true',
                'data-bb-trigger' => '[name=style]',
                'data-bb-value' => '3',
                'style' => ($attributes['style'] ?? 1) == 3 ? '' : 'display: none;',
            ])
            ->add(
                'data_count',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Data count'))
            )
            ->add(
                'data_count_unit',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Data count unit'))
            )
            ->addCloseFieldset('data_count_closed')
            ->add(
                'project_ids',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Projects'))
                    ->choices(
                        Project::query()
                            ->wherePublished()
                            ->pluck('name', 'id')
                            ->all()
                    )
                    ->multiple()
                    ->searchable()
                    ->selected(ShortcodeField::parseIds(Arr::get($attributes, 'project_ids')))
                    ->helperText(__('Leave empty to show all projects'))
            )
            ->add(
                'tabs',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->attrs($attributes)
                    ->collapsible('style', 3, $attributes['style'] ?? 1)
                    ->fields([
                        'title' => [
                            'title' => __('Title'),
                            'required' => true,
                        ],
                        'description' => [
                            'title' => __('Description'),
                            'type' => 'textarea',
                            'required' => true,
                        ],
                    ])
            )
            ->add(
                'limit',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Limit'))
                    ->helperText(__('Specify the number of projects to display. Leave empty to enable pagination.'))
            );
    });

    Shortcode::register('services', __('Services'), __('Services'), function (ShortcodeCompiler $shortcode) {
        if (empty($serviceIds = Shortcode::fields()
            ->getIds('service_ids', $shortcode))) {
            return null;
        }

        $services = Service::query()
            ->whereIn('id', $serviceIds)
            ->wherePublished()
            ->with(['slugable', 'metadata'])
            ->get();

        if ($services->isEmpty()) {
            return null;
        }

        return Theme::partial('shortcodes.services.index', compact('shortcode', 'services'));
    });

    Shortcode::setPreviewImage('services', Theme::asset()->url('images/ui-blocks/services.png'));

    Shortcode::setAdminConfig('services', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'style',
                UiSelectorField::class,
                UiSelectorFieldOption::make()
                    ->label(__('Style'))
                    ->defaultValue($attributes['style'] ?? 1)
                    ->numberItemsPerRow(1)
                    ->withoutAspectRatio()
                    ->choices(
                        collect(range(1, 6))->mapWithKeys(function ($i) {
                            return [
                                $i => [
                                    'label' => __('Style :i', ['i' => $i]),
                                    'image' => Theme::asset()->url("images/shortcodes/services/style-$i.png"),
                                ],
                            ];
                        })->all()
                    )
            )
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->collapsible('style', [1, 3, 4, 5, 6], $attributes['style'] ?? 1)
                    ->label(__('Title'))
            )
            ->add(
                'subtitle',
                TextField::class,
                TextFieldOption::make()
                    ->collapsible('style', [1, 4, 5, 6], $attributes['style'] ?? 1)
                    ->label(__('Subtitle'))
            )
            ->add(
                'description',
                TextareaField::class,
                DescriptionFieldOption::make()
                    ->collapsible('style', [1, 3], $attributes['style'] ?? 1)
            )
            ->add(
                'service_ids',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Services'))
                    ->choices(
                        Service::query()
                            ->wherePublished()
                            ->pluck('name', 'id')
                            ->all()
                    )
                    ->multiple()
                    ->searchable()
                    ->selected(ShortcodeField::parseIds(Arr::get($attributes, 'service_ids')))
            )->addButtonActions([
                'primary' => __('Primary'),
                'secondary' => __('Secondary'),
            ], wrapperAttributes: [
                'data-bb-collapse' => 'true',
                'data-bb-trigger' => '[name=style]',
                'data-bb-value' => '4',
                'style' => in_array(($attributes['style'] ?? 1), [4, 5]) ? '' : 'display: none;',
            ])
            ->add('background_color', ColorField::class, ColorFieldOption::make()->label(__('Background color')))
            ->add(
                'background_image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->collapsible('style', [1, 3, 4, 5, 6], $attributes['style'] ?? 1)
                    ->label(__('Background image'))
            );
    });

    Shortcode::register(
        'pricing-plans',
        __('Pricing Plans'),
        __('Pricing Plans'),
        function (ShortcodeCompiler $shortcode) {
            if (! $packageIds = Shortcode::fields()->getIds('package_ids', $shortcode)) {
                return null;
            }

            $features = explode(PHP_EOL, $shortcode->features) ?? [];

            $paymentGateways = Shortcode::fields()->getTabsData(['name', 'url', 'image'], $shortcode);

            $packages = Package::query()
                ->whereIn('id', $packageIds)
                ->wherePublished()
                ->get();

            if ($packages->isEmpty()) {
                return null;
            }

            return Theme::partial('shortcodes.pricing-plans.index', compact('shortcode', 'packages', 'features', 'paymentGateways'));
        }
    );

    Shortcode::setPreviewImage('pricing-plans', Theme::asset()->url('images/ui-blocks/pricing-plans.png'));

    Shortcode::setAdminConfig('pricing-plans', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->add(
                'style',
                UiSelectorField::class,
                UiSelectorFieldOption::make()
                    ->label(__('Style'))
                    ->defaultValue($attributes['style'] ?? 1)
                    ->numberItemsPerRow(1)
                    ->withoutAspectRatio()
                    ->choices(
                        collect(range(1, 4))->mapWithKeys(function ($i) {
                            return [
                                $i => [
                                    'label' => __('Style :i', ['i' => $i]),
                                    'image' => Theme::asset()->url("images/shortcodes/pricing-plans/style-$i.png"),
                                ],
                            ];
                        })->all()
                    )
            )
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()->label(__('Title'))
            )
            ->add(
                'subtitle',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Subtitle'))
            )
            ->add(
                'description',
                TextareaField::class,
                DescriptionFieldOption::make()
            )
            ->add(
                'features',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->collapsible('style', 2, $attributes['style'] ?? 1)
                    ->label(__('Features'))
                    ->placeholder(__('Feature :number', ['number' => 1]) . PHP_EOL . __('Feature :number', ['number' => 2]) . PHP_EOL . __('Feature :number', ['number' => 3]))
                    ->helperText(__('Each new line is a heading separated by a line break.'))
            )
            ->add(
                'bottom_title',
                TextField::class,
                TextFieldOption::make()
                    ->collapsible('style', 2, $attributes['style'] ?? 1)
                    ->label(__('Bottom Title'))
            )
            ->add(
                'tabs',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->attrs($attributes)
                    ->collapsible('style', 2, $attributes['style'] ?? 1)
                    ->fields([
                        'name' => [
                            'title' => __('Name'),
                            'required' => true,
                        ],
                        'url' => [
                            'title' => __('URL'),
                        ],
                        'image' => [
                            'type' => 'image',
                            'title' => __('Image'),
                            'required' => true,
                        ],
                    ])
            )
            ->add(
                'package_ids',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Packages'))
                    ->choices(
                        Package::query()
                            ->wherePublished()
                            ->pluck('name', 'id')
                            ->all()
                    )
                    ->multiple()
                    ->searchable()
                    ->selected(ShortcodeField::parseIds(Arr::get($attributes, 'package_ids')))
            )
            ->addButtonActions([
                'primary' => __('Primary'),
                'secondary' => __('Secondary'),
            ], wrapperAttributes: [
                'data-bb-collapse' => 'true',
                'data-bb-trigger' => '[name=style]',
                'data-bb-value' => '3',
                'style' => ($attributes['style'] ?? 1) == 2 ? '' : 'display: none;',
            ]);
    });

    Shortcode::register('project-tabs', __('Project Tabs'), __('Project Tabs'), function (ShortcodeCompiler $shortcode) {
        $tabs = Shortcode::fields()->getTabsData(['title', 'project_ids'], $shortcode);

        $allProjectIds = [];

        foreach ($tabs as $tab) {
            $projectIds = $tab['project_ids'];
            $projectIds = is_string($projectIds) ? explode(',', $projectIds) : [];

            $allProjectIds = [...$allProjectIds, ...$projectIds];
        }

        $allProjectIds = array_unique(array_filter($allProjectIds));

        $projects = Project::query()
            ->with('slugable')
            ->whereIn('id', $allProjectIds)
            ->wherePublished()
            ->get();

        return Theme::partial('shortcodes.project-tabs.index', compact('shortcode', 'tabs', 'projects'));
    });

    Shortcode::setPreviewImage('project-tabs', Theme::asset()->url('images/ui-blocks/project-tabs.png'));

    Shortcode::setAdminConfig('project-tabs', function (array $attributes) {
        foreach ($attributes as $key => $value) {
            if (Str::startsWith($key, 'project_ids')) {
                $attributes[$key] = is_string($value) ? explode(',', $value) : $value;
            }
        }

        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title'))
            )
            ->add(
                'subtitle',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Subtitle'))
            )
            ->add(
                'description',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label(__('Description'))
                    ->rows(2)
            )
            ->add(
                'tabs',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->attrs($attributes)
                    ->fields([
                        'title' => [
                            'title' => __('Title'),
                            'required' => true,
                        ],
                        'project_ids' => [
                            'title' => __('Projects'),
                            'type' => 'select',
                            'attributes' => [
                                'class' => 'select-multiple',
                                'searchable' => true,
                                'multiple' => true,
                            ],
                            'options' => Project::query()
                                ->wherePublished()
                                ->pluck('name', 'id')
                                ->all(),
                        ],
                    ])
            )
            ->addButtonActions([
                'primary' => __('Primary'),
                'secondary' => __('Secondary'),
            ])
            ->add('background_image', MediaImageField::class, MediaImageFieldOption::make()->label(__('Background image')));
    });
});
