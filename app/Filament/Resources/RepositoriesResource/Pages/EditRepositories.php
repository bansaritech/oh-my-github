<?php

namespace App\Filament\Resources\RepositoriesResource\Pages;

use App\Filament\Resources\RepositoriesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRepositories extends EditRecord
{
    protected static string $resource = RepositoriesResource::class;

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
