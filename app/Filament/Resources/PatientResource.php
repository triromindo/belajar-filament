<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Patient;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Resources\PatientResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PatientResource\RelationManagers;
use Filament\GlobalSearch\Actions\Action;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                static::getNameFormField(),
                static::getDOBFormField(),
                static::getTypeFormField(),
                static::getOwnerFormField(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('type')
                    ->searchable(),
                TextColumn::make('date_of_birth')
                    ->dateTime('d M Y')
                    ->sortable(),
                TextColumn::make('owner.name')
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'cat' => 'Cat',
                        'dog' => 'Dog',
                        'rabbit' => 'Rabbit',
                    ]),
                SelectFilter::make('owner')
                    ->relationship('owner', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\TreatmentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
            'view' => Pages\ViewPatient::route('/{record}/view'),
        ];
    }

    public static function getNameFormField(): Forms\Components\TextInput
    {
        return TextInput::make('name')
            ->required();
    }

    public static function getDOBFormField(): Forms\Components\DatePicker
    {
        return DatePicker::make('date_of_birth')
            ->required()
            ->maxDate(now());
    }

    public static function getTypeFormField(): Forms\Components\Select
    {
        return Select::make('type')
            ->required()
            ->options([
                'cat' => 'Cat',
                'dog' => 'Dog',
                'rabbit' => 'Rabbit',
            ]);
    }

    public static function getOwnerFormField(): Forms\Components\Select
    {
        return Select::make('owner_id')
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
            ->required();
    }

    public static function getGlobalSearchResultTitle(Model $record): string|Htmlable
    {
        return $record->name;
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'type', 'owner.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Owner' => $record->owner->name,
            'Type' => $record->type,
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['owner']);
    }
    public static function getGlobalSearchResultUrl(Model $record): string
    {
        return PatientResource::getUrl('view', ['record' => $record]);
    }

    public static function getGlobalSearchResultActions(Model $record): array
    {
        return [
            Action::make('edit')
            ->button()
                ->url(static::getUrl('edit', ['record' => $record]), true),
            Action::make('details')
            ->button()
                ->url(static::getUrl('view', ['record' => $record])),
        ];
    }
}
