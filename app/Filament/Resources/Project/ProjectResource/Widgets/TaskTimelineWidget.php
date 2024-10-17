<?php

namespace App\Filament\Resources\Project\ProjectResource\Widgets;

use App\Models\Project\Task;
use Filament\Widgets\Widget;
use Guava\Calendar\ValueObjects\Event;
use Guava\Calendar\Widgets\CalendarWidget;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Locked;

class TaskTimelineWidget extends CalendarWidget
{
    protected string $calendarView = 'listMonth';

    #[Locked]
    public Model | int | string | null $record;

    public function getEvents(array $fetchInfo = []): Collection | array
    {
        return Task::where('project_id',$this->record->id)->get()->map(function ($task) {
            return [
                'title' => $task->name,
                'start' => $task->start,
                'end' => $task->end,
            ];
        })->toArray();
    }



}
