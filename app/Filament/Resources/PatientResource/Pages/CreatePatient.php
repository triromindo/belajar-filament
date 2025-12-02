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
                    TextInput::make('name')
                        ->required()
                ]),
            Step::make('Date of Birth')
                ->description('Date of birth of your patient')
                ->schema([
                    DatePicker::make('date_of_birth')
                        ->required()
                        ->maxDate(now()),
                ]),
            Step::make('Patient Type')
                ->description('Choose your patient Type.')
                ->schema([
                    Select::make('type')
                        ->required()
                        ->options([
                            'cat' => 'Cat',
                            'dog' => 'Dog',
                            'rabbit' => 'Rabbit',
                        ]),
                ]),
            Step::make('Owner')
                ->description('Choose your patient Owner.')
                ->schema([
                    Select::make('owner_id')
                        ->relationship('owner', 'name')
                        ->searchable()
                        ->preload()
                        ->createOptionForm([
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('email')
                                ->label('Email address')
                                ->email()
                                ->required()
                                ->maxLength(255),
                            TextInput::make('phone')
                                ->label('Phone number')
                                ->tel()
                                ->required(),
                        ])
                        ->required()
                ]),
        ];
    }
}
