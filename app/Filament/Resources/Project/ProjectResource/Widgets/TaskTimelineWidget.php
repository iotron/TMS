<?php

namespace App\Filament\Resources\Project\ProjectResource\Widgets;

use App\Models\Project\Task;
use Closure;
use Filament\Forms\Components\TextInput;
use Filament\Widgets\Widget;
use Guava\Calendar\Actions\CreateAction;
use Guava\Calendar\Widgets\CalendarWidget;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Locked;

class TaskTimelineWidget extends CalendarWidget
{
    // Set the view of the calendar (can be dayGridMonth, listMonth, etc.)
//    protected string $calendarView = 'dayGridMonth';

    protected bool $eventClickEnabled = true;

    protected ?string $defaultEventClickAction = 'edit';

    public function authorize($ability, $arguments = [])
    {
        return true;
    }

    public function getSchema(?string $model = null): ?array
    {
        return [
            TextInput::make('title'),
        ];
    }









    /**
     * Retrieve events for the calendar widget.
     * Convert each task into an Event object using the toEvent method.
     */
    public function getEvents(array $fetchInfo = []): Collection | array
    {
        Log::info('getEvents method is being called.');
        // Fetch tasks related to the current project
       // return Task::where('project_id', $this->record->id)

        return Task::query()
            ->get()
            ->map(fn ($task) => $task->toEvent()) // Convert each task to an Event
            ->toArray();
    }

 


}
