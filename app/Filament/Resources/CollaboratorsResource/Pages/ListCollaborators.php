<?php

namespace App\Filament\Resources\CollaboratorsResource\Pages;

use App\Filament\Resources\CollaboratorsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListCollaborators extends ListRecords
{
    protected static string $resource = CollaboratorsResource::class;

    protected function getActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

}
