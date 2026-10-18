<?php

namespace Botble\PopupChat\Providers;

use Botble\Theme\Events\RenderingThemeOptionSettings;
use Botble\Base\Supports\ServiceProvider;

class HookServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app['events']->listen(RenderingThemeOptionSettings::class, function (): void {
            add_action(RENDERING_THEME_OPTIONS_PAGE, [$this, 'addThemeOptions'], 55);
        });
    }

    public function addThemeOptions(): void
    {
        theme_option()
            ->setSection([
                'title' => __('Chat Button'),
                'id' => 'opt-text-subsection-chat-buttons',
                'subsection' => true,
                'icon' => 'fa fa-comments',
                'fields' => [
                    [
                        'id' => 'chat_btn_bottom',
                        'type' => 'text',
                        'label' => __('Bottom distance (px)'),
                        'attributes' => [
                            'name' => 'chat_btn_bottom',
                            'value' => '20',
                            'options' => [
                                'class' => 'form-control',
                                'placeholder' => '20',
                            ],
                        ],
                    ],
                    [
                        'id' => 'chat_btn_right',
                        'type' => 'text',
                        'label' => __('Right distance (px)'),
                        'attributes' => [
                            'name' => 'chat_btn_right',
                            'value' => '20',
                            'options' => [
                                'class' => 'form-control',
                                'placeholder' => '20',
                            ],
                        ],
                    ],
                    [
                        'id' => 'chat_btn_repeater',
                        'type' => 'repeater',
                        'label' => __('Chat Buttons'),
                        'attributes' => [
                            'name' => 'chat_btn_repeater',
                            'value' => null,
                            'fields' => [
                                [
                                    'type' => 'text',
                                    'label' => __('Name'),
                                    'attributes' => [
                                        'name' => 'name',
                                        'value' => null,
                                        'options' => [
                                            'class' => 'form-control',
                                            'placeholder' => __('Facebook, Zalo, ...'),
                                        ],
                                    ],
                                ],
                                [
                                    'type' => 'mediaImage',
                                    'label' => __('SVG (Ảnh)'),
                                    'attributes' => [
                                        'name' => 'image',
                                        'value' => null,
                                    ],
                                ],
                                [
                                    'type' => 'customColor',
                                    'label' => __('Background Color'),
                                    'attributes' => [
                                        'name' => 'color',
                                        'value' => '#ffffff',
                                    ],
                                ],
                                [
                                    'type' => 'text',
                                    'label' => __('Link'),
                                    'attributes' => [
                                        'name' => 'link',
                                        'value' => null,
                                        'options' => [
                                            'class' => 'form-control',
                                            'placeholder' => __('https://...'),
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]);
    }
}
