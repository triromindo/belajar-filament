<?php

namespace App\Filament\Resources\PatientResource\Pages;

use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\PatientResource;

class CreatePatient extends CreateRecord
{

    use CreateRecord\Concerns\HasWizard;
    protected static string $resource = PatientResource::class;

    protected function getSteps(): array
    {
        return [
            Step::make('Name')
                ->description('Give a name to your patient')
                ->schema([
                    PatientResource::getNameFormField(),
                ]),
            Step::make('Date of Birth')
                ->description('Date of birth of your patient')
                ->schema([
                    PatientResource::getDOBFormField(),
                ]),
            Step::make('Patient Type')
                ->description('Choose your patient Type.')
                ->schema([
                    PatientResource::getTypeFormField(),
                ]),
            Step::make('Owner')
                ->description('Choose your patient Owner.')
                ->schema([
                    PatientResource::getOwnerFormField(),
                ]),
        ];
    }
}
