<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CitiesResource\Pages;
use App\Models\Cities;
use App\Models\Countries;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CitiesResource extends Resource
{
    protected static ?string $model = Cities::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->unique(Cities::class, 'name'),

                Forms\Components\TextInput::make('zip_code')
                    ->label('Zip Code')
                    ->required()
                    ->unique(Cities::class, 'zip_code'),

                Forms\Components\Select::make('country_id')
                    ->label('Country')
                    ->required()
                    ->options(Countries::all()->pluck('name', 'id'))
                    ->searchable()
                    ->placeholder('Select a country')
                    ->rules(['exists:countries,id']),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label(__('Name'))->searchable()->sortable(),
                Tables\Columns\TextColumn::make('country.name')->label(__('Country'))->searchable()->sortable(),
            ])
            ->filters([
                //
            ])
            ->defaultSort('name', 'asc')
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCities::route('/'),
            'create' => Pages\CreateCities::route('/create'),
            'edit' => Pages\EditCities::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): string
    {
        return __('module_names.navigation_groups.administration');
    }
}
