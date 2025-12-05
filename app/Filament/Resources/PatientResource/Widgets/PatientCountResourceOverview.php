<?php

namespace App\Filament\Resources\PatientResource\Widgets;

use App\Models\Patient;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class PatientCountResourceOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Patinets', Patient::count())
                ->description('Total Number of patient')
                ->color('primary')
                ->icon('heroicon-m-user-group'),

            Stat::make('Total Patinets', 5)
                ->description('Total Number of patient')
                ->color('primary')
                ->icon('heroicon-m-user-group')
        ];
    }
}
