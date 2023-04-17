<?php

namespace App\Filament\Resources\RepositoriesResource\Pages;

use App\Filament\Resources\RepositoriesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListRepositories extends ListRecords
{
    protected static string $resource = RepositoriesResource::class;

    protected function getActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
