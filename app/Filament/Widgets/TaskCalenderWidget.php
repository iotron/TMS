<?php

namespace App\Filament\Widgets;

use App\Models\Project\Task;
use Filament\Widgets\Widget;
use Guava\Calendar\Actions\CreateAction;
use Guava\Calendar\ValueObjects\Event;
use Guava\Calendar\Widgets\CalendarWidget;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class TaskCalenderWidget extends CalendarWidget
{
    protected static string $view = 'filament.widgets.task-calender-widget';

//    protected string $calendarView = 'dayGridMonth';



    public function getEvents(array $fetchInfo = []): array
    {
        // Example of returning a simple array of events
        return [
            [
                'title' => 'Sample Event',
                'start' => now()->toISOString(),
                'end' => now()->addHours(2)->toISOString(),
            ],
            [
                'title' => 'Another Event',
                'start' => now()->addDays(1)->toISOString(),
                'end' => now()->addDays(1)->addHours(2)->toISOString(),
            ],
        ];
    }




}
