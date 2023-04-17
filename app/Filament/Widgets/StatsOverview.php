<?php

namespace App\Filament\Widgets;

use App\Models\Collaborator;
use App\Models\GithubRepo;
use App\Models\Scan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Repositorties', GithubRepo::count()),
            Card::make('Collaborators', Collaborator::count()),
            Card::make('Scan Jobs', Scan::count()),
        ];
    }
}
