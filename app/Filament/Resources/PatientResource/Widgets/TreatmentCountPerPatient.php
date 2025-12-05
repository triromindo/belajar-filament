<?php

namespace App\Filament\Resources\PatientResource\Widgets;

use App\Models\Patient;
use App\Models\Treatment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Model;

class TreatmentCountPerPatient extends BaseWidget
{
    public ?Model $record = null;
    protected function getStats(): array
    {
        return [
            Stat::make("Total Treatment", Treatment::where('patient_id', $this->record->id)->count())
        ];
    }
}
