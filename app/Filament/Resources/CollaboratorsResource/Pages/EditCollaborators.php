<?php

namespace App\Filament\Resources\CollaboratorsResource\Pages;

use App\Filament\Resources\CollaboratorsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCollaborators extends EditRecord
{
    protected static string $resource = CollaboratorsResource::class;

    protected function getActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    
}
