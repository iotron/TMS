<?php

namespace App\Filament\Resources\Project\ProjectResource\Pages;

use App\Casts\StatusCast;
use App\Filament\Resources\Project\ProjectResource;
use App\Models\Project\Project;
use App\Models\Project\Task;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Resources\Pages\Page;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Livewire\Attributes\Locked;
use Mokhosh\FilamentKanban\Concerns\HasEditRecordModal;
use Mokhosh\FilamentKanban\Concerns\HasStatusChange;
use UnitEnum;

class ManageTaskTimeline extends ManageRelatedRecords
{
    protected static string $resource = ProjectResource::class;

    protected static string $relationship = 'tasks';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $title = 'Task Timeline';
    protected static ?string $navigationLabel = 'Timeline';


    protected function getHeaderWidgets(): array
    {
        return [
            ProjectResource\Widgets\TaskTimelineWidget::class
        ];
    }


}
