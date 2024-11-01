<?php

namespace App\Filament\Resources\Project\SprintResource\Pages;

use App\Filament\Resources\Project\SprintResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSprint extends EditRecord
{
    protected static string $resource = SprintResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
