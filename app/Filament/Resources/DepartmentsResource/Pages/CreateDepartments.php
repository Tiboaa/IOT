<?php

namespace App\Filament\Resources\DepartmentsResource\Pages;

use App\Filament\Resources\DepartmentsResource;
use App\Models\Departments;
use Doctrine\Inflector\Rules\English\Rules;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms;

class CreateDepartments extends CreateRecord
{
    protected static string $resource = DepartmentsResource::class;

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('code')
                ->label('Code')
                ->required()
                ->unique(Departments::class, 'code'),


            Forms\Components\TextInput::make('name')
                ->label('Name')
                ->required()
                ->unique(Departments::class, 'name'),
        ];
    }
}
