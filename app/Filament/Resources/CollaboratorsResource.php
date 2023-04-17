<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CollaboratorsResource\Pages;
use App\Filament\Resources\CollaboratorsResource\RelationManagers;
use App\Filament\Resources\CollaboratorsResource\RelationManagers\GithubReposRelationManager;
use App\Models\Collaborator;
use App\Models\Collaborators;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Relationship;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CollaboratorsResource extends Resource
{
    protected static ?string $model = Collaborator::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make('name')->disabled(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('details.avatar_url')->label('Pic'),
                TextColumn::make('name'),
                TextColumn::make('repositories_count')->counts('repositories'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            GithubReposRelationManager::class
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCollaborators::route('/'),
            'create' => Pages\CreateCollaborators::route('/create'),
            'edit' => Pages\EditCollaborators::route('/{record}/edit'),
        ];
    }    
}
