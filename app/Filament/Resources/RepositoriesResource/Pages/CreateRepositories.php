<?php

namespace App\Filament\Resources\RepositoriesResource\Pages;

use App\Filament\Resources\RepositoriesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRepositories extends CreateRecord
{
    protected static string $resource = RepositoriesResource::class;

    protected function canCreate(): bool
    {
       return false;
    }

}
