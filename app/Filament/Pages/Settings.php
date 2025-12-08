<?php

namespace App\Filament\Pages;

use App\Filament\Resources\OwnerResource;
use App\Filament\Resources\PatientResource;
use App\Filament\Resources\ToolResource;
use App\Filament\Widgets\PatientTypeOverview;
use App\Filament\Widgets\TreatmentsChart;
use Filament\Pages\Page;
use Filament\Actions\Action;
use function PHPUnit\Framework\returnArgument;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-8-tooth';

    protected static string $view = 'filament.pages.settings';

    protected static ?string $slug = 'pengaturan';

    protected ?string $heading = 'Pengaturan';
    protected ?string $subheading = 'Page Pengaturan';

    protected static ?string $title = 'pengaturan';

    public static function canAccess(): bool
    {
        return auth()->user()->id == 1;
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Tools')
                ->action(fn() => redirect()->to(ToolResource::getUrl('index'))),
            Action::make('Owners')
                ->action(fn() => redirect()->to(OwnerResource::getUrl('index'))),
            Action::make('Patients')
                ->action(fn() => redirect()->to(PatientResource::getUrl('index'))),
        ];
    }

    public function getHeaderWidgets(): array
    {
        return [
            TreatmentsChart::class,
            PatientTypeOverview::class
        ];
    }

    public function getHeaderWidgetsColumns(): array|int|string
    {
        return 3;
    }
}
