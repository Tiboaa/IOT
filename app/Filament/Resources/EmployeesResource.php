<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeesResource\Pages;
use App\Filament\Resources\EmployeesResource\Widgets\EmployeesOverview;
use App\Filament\Resources\EmployeesResource\RelationManagers;
use App\Models\Employees;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeesResource extends Resource
{
    protected static ?string $model = Employees::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('fields.name'))
                            ->required()
                            ->maxLength(255),
    
                        Forms\Components\TextInput::make('id_number')
                            ->label(__('fields.id_number'))
                            ->required()
                            ->unique(Employees::class, 'id_number', ignoreRecord: true)
                            ->length(8),
    
                        Forms\Components\TextInput::make('department_code')
                            ->label(__('fields.department_code'))
                            ->required()
                            ->maxLength(4)
                            ->rules(['exists:departments,code']),
    
                        Forms\Components\DatePicker::make('date_of_birth')
                            ->label(__('fields.date_of_birth'))
                            ->required(),
    
                        Forms\Components\TextInput::make('adress')
                            ->label(__('fields.adress'))
                            ->required()
                            ->maxLength(255),
    
                        Forms\Components\TextInput::make('email')
                            ->label(__('fields.email'))
                            ->required()
                            ->email()
                            ->maxLength(255),
    
                        Forms\Components\TextInput::make('phone')
                            ->label(__('fields.phone'))
                            ->required()
                            ->maxLength(255),
    
                        Forms\Components\Textarea::make('notes')
                            ->label(__('fields.notes'))
                            ->nullable()
                            ->maxLength(65535), // Default max length for text fields
                    ]),
            ]);
    }
    

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label(__('Name'))->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->label(__('Email'))->searchable(),
                Tables\Columns\TextColumn::make('phone')->label(__('Phone'))->searchable()
            ])
            ->filters([
                //
            ])
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployees::route('/create'),
            'edit' => Pages\EditEmployees::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): string
    {
        return __('module_names.navigation_groups.administration');
    }
    
    public static function getModelLabel(): string
    {
      return __('module_names.employees.label');
    }
    
    public static function getPluralModelLabel(): string
    {
      return __('module_names.employees.plural_label');
    }
}
