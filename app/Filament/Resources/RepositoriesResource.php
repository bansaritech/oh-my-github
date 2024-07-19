<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RepositoriesResource\Pages;
use App\Filament\Resources\RepositoriesResource\RelationManagers\CollaboratorsRelationManager;
use App\Models\GithubRepo;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;

class RepositoriesResource extends Resource
{
    protected static ?string $model = GithubRepo::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make('name')->disabled(),
                    TextInput::make('branch_limit')->default(5)->disabled(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('branch_limit')->label('Branch Limit'),
                TextColumn::make('collaborators_count')->counts('collaborators')
            ])
            ->filters([])
            ->actions([])
            ->bulkActions([]);
    }
    
    public static function getRelations(): array
    {
        return [
            CollaboratorsRelationManager::class
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRepositories::route('/'),
            'create' => Pages\CreateRepositories::route('/create'),
            'edit' => Pages\EditRepositories::route('/{record}/edit'),
        ];
    }
}

// <!-- ?php

// namespace App\Filament\Resources;

// use App\Filament\Resources\RepositoriesResource\Pages;
// use App\Filament\Resources\RepositoriesResource\RelationManagers;
// use App\Filament\Resources\RepositoriesResource\RelationManagers\CollaboratorsRelationManager;
// use App\Models\Collaborator;
// use App\Models\GithubRepo;
// use App\Models\Repositories;
// use Filament\Forms;
// use Filament\Forms\Components\Card;
// use Filament\Forms\Components\Checkbox;
// use Filament\Forms\Components\TextInput;
// use Filament\Resources\Form;
// use Filament\Resources\Resource;
// use Filament\Resources\Table;
// use Filament\Tables;
// use Filament\Tables\Columns\TextColumn;
// use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Eloquent\SoftDeletingScope;

// class RepositoriesResource extends Resource
// {
//     protected static ?string $model = GithubRepo::class;

//     protected static ?string $navigationIcon = 'heroicon-o-collection';

//     public static function form(Form $form): Form
//     {
//         return $form
//             ->schema([
//                 Card::make([
//                     TextInput::make('name')->disabled(),
//                     Checkbox::make('fork')->disabled(),
//                     TextInput::make('branch_limit')->default(5)->disabled(),
//                 ])
//             ]);
//     }

//     public static function table(Table $table): Table
//     {
//         return $table
//             ->columns([
//                 //
//                 TextColumn::make('name'),
//                 TextColumn::make('branch_limit')->label('Branch Limit'),
//                 TextColumn::make('collaborators_count')->counts('collaborators')

//             ])
//             ->filters([
//                 //
//             ])
//             ->actions([
//                 // Tables\Actions\EditAction::make(),
//             ])
//             ->bulkActions([
//                 // Tables\Actions\DeleteBulkAction::make(),
//             ]);
//     }
    
//     public static function getRelations(): array
//     {
//         return [
//             CollaboratorsRelationManager::class
//         ];
//     }
    
//     public static function getPages(): array
//     {
//         return [
//             'index' => Pages\ListRepositories::route('/'),
//             'create' => Pages\CreateRepositories::route('/create'),
//             'edit' => Pages\EditRepositories::route('/{record}/edit'),
//         ];
//     }    
// } -->
