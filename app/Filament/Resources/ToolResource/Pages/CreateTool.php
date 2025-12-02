<?php

namespace App\Filament\Resources\ToolResource\Pages;

use Filament\Actions;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\ToolResource;
use App\Filament\Resources\OwnerResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTool extends CreateRecord
{
    protected static string $resource = ToolResource::class;

    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     $data['name'] = 'Renamed Tool';

    //     return $data;
    // }

    // protected function handleRecordCreation(array $data): Model
    // {
    //     OwnerResource::getModel()::create([
    //         'email' => 'test@email.com',
    //         'name' => 'test',
    //         'phone' => 123
    //     ]);
    //     return static::getModel()::create($data);
    // }
}
