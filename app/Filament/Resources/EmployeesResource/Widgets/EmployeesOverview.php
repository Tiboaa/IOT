<?php

namespace App\Filament\Resources\EmployeesResource\Widgets;

use App\Models\Employees;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EmployeesOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Employees', Employees::query()->count())->label('Total Employees'),
        ];
    }

}
