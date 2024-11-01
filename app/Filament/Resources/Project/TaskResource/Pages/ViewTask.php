<?php

namespace App\Filament\Resources\Project\TaskResource\Pages;

use App\Filament\Resources\Project\TaskResource;
use App\Models\Project\Sprint;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewTask extends ViewRecord
{
    protected static string $resource = TaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()->icon('heroicon-c-pencil-square'),


            Actions\Action::make('add_to_sprint')
                ->label('Add to Sprint')
                ->fillForm(['sprint_id' => $this->record->sprint_id])
                ->visible(fn() => filament()->auth()->user()->can('update_task'))
                ->icon('heroicon-c-plus-circle')
                ->form([
                    Select::make('sprint_id')
                        ->label(__('Choose Sprint'))
                        ->options(Sprint::where('project_id',$this->record->project_id)->get()->pluck('name','id'))
                        ->required()
                ])->action(function (array $data){
                    $this->record->update(['sprint_id' => $data['sprint_id']]);
                    Notification::make()->title('Added to Sprint')->success()->send();
                })

        ];
    }
}
