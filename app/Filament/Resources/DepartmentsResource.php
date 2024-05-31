<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartmentsResource\Pages;
use App\Models\Cities;
use App\Models\Countries;
use App\Models\Departments;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DepartmentsResource extends Resource
{
    protected static ?string $model = Departments::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->minLength(6)
                    ->maxLength(256)
                    ->required()
                    ->unique(Departments::class, 'name'),

                Forms\Components\TextInput::make('code')
                    ->label('Code')
                    ->length(4)
                    ->required()
                    ->unique(Departments::class, 'code'),

                Forms\Components\Select::make('country')
                    ->label('Country')
                    ->required()
                    ->options(Countries::all()->pluck('name', 'name'))
                    ->searchable()
                    ->placeholder('Select a country')
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('city_name', null)), 
                    
                Forms\Components\Select::make('city_name')
                    ->label('City Name')
                    ->required()
                    ->placeholder('Select city name')
                    ->options(function ($get) {
                        $countryName = $get('country');
                        if ($countryName) {
                            $countryId = Countries::where('name', $countryName)->first()->id;
                            return Cities::where('country_id', $countryId)->pluck('name', 'name');
                        }
                        return [];
                    })
                    ->searchable()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('city_zip', null))
                    ->rules(['exists:cities,name']),

                Forms\Components\Select::make('city_zip')
                    ->label('City Zip')
                    ->required()
                    ->placeholder('Select city zip code')
                    ->options(function ($get) {
                        $cityName = $get('city_name');
                        if ($cityName) {
                            return Cities::where('name', $cityName)->pluck('zip_code', 'zip_code');
                        }
                        return [];
                    })
                    ->searchable()
                    ->reactive()
                    ->rules(['exists:cities,zip_code']),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')->label(__('Code'))->searchable()->sortable(),
                Tables\Columns\TextColumn::make('name')->label(__('Name'))->searchable()->sortable(),
                Tables\Columns\TextColumn::make('city.name')->label(__('City'))->searchable()->sortable(),
                Tables\Columns\TextColumn::make('country')->label(__('Country'))->searchable()->sortable(),
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
            'index' => Pages\ListDepartments::route('/'),
            'create' => Pages\CreateDepartments::route('/create'),
            'edit' => Pages\EditDepartments::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): string
    {
        return __('module_names.navigation_groups.administration');
    }
}
