<?php

namespace App\Filament\Resources\Project\SprintResource\Pages;

use App\Filament\Resources\Project\SprintResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSprints extends ListRecords
{
    protected static string $resource = SprintResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->icon('heroicon-c-plus-circle'),
        ];
    }
}
