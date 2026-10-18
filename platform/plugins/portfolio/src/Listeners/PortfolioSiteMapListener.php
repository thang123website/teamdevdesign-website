<?php

namespace Botble\Portfolio\Listeners;

use Botble\Portfolio\Models\Project;
use Botble\Portfolio\Models\Service;
use Botble\Theme\Events\RenderingSiteMapEvent;
use Botble\Theme\Facades\SiteMapManager;

class PortfolioSiteMapListener
{
    public function handle(RenderingSiteMapEvent $event): void
    {
        if ($event->key && $event->key != 'sitemap' && ! in_array($event->key, SiteMapManager::getKeys())) {
            return;
        }

        $projectLastUpdated = Project::query()
            ->wherePublished()
            ->latest('updated_at')
            ->value('updated_at');

        if ($event->key == 'projects') {
            $projects = Project::query()
                ->with('slugable')
                ->wherePublished()
                ->select(['id', 'name', 'updated_at'])
                ->latest()
                ->get();

            foreach ($projects as $project) {
                if (! $project->slugable) {
                    continue;
                }

                SiteMapManager::add($project->url, $project->updated_at, '0.8');
            }

            return;
        }

        SiteMapManager::addSitemap(SiteMapManager::route('projects'), $projectLastUpdated);

        $serviceLastUpdated = Service::query()
            ->wherePublished()
            ->latest('updated_at')
            ->value('updated_at');

        if ($event->key == 'services') {
            $services = Service::query()
                ->with('slugable')
                ->wherePublished()
                ->select(['id', 'name', 'updated_at'])
                ->latest()
                ->get();

            foreach ($services as $service) {
                if (! $service->slugable) {
                    continue;
                }

                SiteMapManager::add($service->url, $service->updated_at, '0.8');
            }

            return;
        }

        SiteMapManager::addSitemap(SiteMapManager::route('services'), $serviceLastUpdated);
    }
}
