<?php

namespace App\Filament\Resources\PatientResource\Widgets;

use App\Models\Patient;
use Filament\Widgets\ChartWidget;

class PatientCountByTypeChart extends ChartWidget
{
    protected static ?string $heading = 'Patient By Type';

    protected function getData(): array
    {
        $data = Patient::query()
        ->SelectRaw('type, count(*) as count')
        ->groupBy('type')
        ->get()
        ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Treatments',
                    'data' => collect($data)->pluck('count'),
                ],
            ],
            'labels' => collect($data)->pluck('type')
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
