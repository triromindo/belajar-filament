<?php

namespace App\Filament\Resources\ToolResource\Pages;

use Filament\Actions;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\ToolResource;
use Filament\Notifications\Notification;
use App\Filament\Resources\OwnerResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Actions\Action;

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

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // protected function getCreatedNotificationTitle(): ?string
    // {
    //     return 'Success membuat tools';
    // }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('User registered')
            ->body('The user has been created successfully.');
    }

    protected function beforeCreate(): void
    {
        // if (auth()->user()->id == 5) {
        Notification::make()
            ->warning()
            ->title('You don\'t have an active subscription!')
            ->body('Choose a plan to continue.')
            ->persistent()
            ->actions([
                Action::make('subscribe')
                    ->button()
                    ->url(OwnerResource::getUrl('index'), shouldOpenInNewTab: true),
            ])
            ->send();

        $this->halt();
        // }
    }
}
