<?php

namespace App\Filament\Resources\Project\ProjectResource\Widgets;

use App\Filament\Resources\Project\TaskResource;
use App\Models\Project\Task;
use Illuminate\Database\Eloquent\Model;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
use Filament\Forms;
use Saade\FilamentFullCalendar\Actions;

class FullCalendarTimelineWidget extends FullCalendarWidget
{

    public string|int|null|Model $record;

    public string|null|\Illuminate\Database\Eloquent\Model $model = Task::class;


    public function fetchEvents(array $fetchInfo): array
    {

        return Task::query()
            ->where('project_id','=',$this->record->id)
//            ->where('start', '>=', $fetchInfo['start'])
//            ->where('end', '<=', $fetchInfo['end'])
            ->get()
            ->map(
                fn (Task $task) => [
                    'title' => $task->name,
                    'start' => $task->start,
                    'end' => $task->end,
                    'url' => TaskResource::getUrl(name: 'view', parameters: ['record' => $task->id]),
                    'shouldOpenUrlInNewTab' => true
                ]
            )
            ->all();
    }








    protected function headerActions(): array
    {
        return [
           // Actions\CreateAction::make(),
        ];
    }

    protected function modalActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function viewAction(): Actions\ViewAction
    {
        return Actions\ViewAction::make();
    }

    public function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name'),

            Forms\Components\Grid::make()
                ->schema([
                    Forms\Components\DateTimePicker::make('start'),

                    Forms\Components\DateTimePicker::make('end'),
                ]),
        ];
    }





}
