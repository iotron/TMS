<?php

namespace App\Filament\Resources\Project\SprintResource\Pages;

use App\Filament\Resources\Project\SprintResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSprint extends ViewRecord
{
    protected static string $resource = SprintResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()->icon('heroicon-c-pencil-square'),
        ];
    }
}
