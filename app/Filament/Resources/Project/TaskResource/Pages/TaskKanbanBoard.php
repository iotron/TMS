<?php

namespace App\Filament\Resources\Project\TaskResource\Pages;

use App\Casts\StatusCast;
use App\Filament\Resources\Project\ProjectResource;
use App\Filament\Resources\Project\TaskResource;
use App\Models\Project\Project;
use App\Models\Project\Task;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Resources\Pages\Concerns\HasRelationManagers;
use Filament\Resources\Pages\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Livewire\Attributes\Locked;
use Mokhosh\FilamentKanban\Concerns\HasEditRecordModal;
use Mokhosh\FilamentKanban\Concerns\HasStatusChange;
use UnitEnum;
use Filament\Actions;

class TaskKanbanBoard extends Page
{
    protected static string $resource = TaskResource::class;

    use HasEditRecordModal;
    use HasStatusChange;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $relationship = 'tasks';

    #[Locked]
    public Model | int | string | null $record;
    protected static string $model = Task::class;
    protected static string $statusEnum = StatusCast::class;
    protected static string $recordTitleAttribute = 'name';
    protected static string $recordStatusAttribute = 'status';

    protected static string $view = 'filament-kanban::kanban-board';
    protected static string $headerView = 'filament-kanban::kanban-header';
    protected static string $recordView = 'filament-kanban::kanban-record';
    protected static string $statusView = 'filament-kanban::kanban-status';
    protected static string $scriptsView = 'filament-kanban::kanban-scripts';


    public static function getNavigationLabel(): string
    {
        return 'Kanban Board';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('list_view')
                ->label('View List')
                ->icon('heroicon-c-list-bullet')
                ->color('primary')
                ->url(fn() => self::$resource::getUrl())
        ];
    }



    protected function authorizeAccess(): void
    {
        abort_unless(static::canAccess(['record' => $this->getRecord()]), 403);
    }

    protected function statuses(): Collection
    {
        return static::$statusEnum::statuses();
    }

    protected function records(): Collection
    {
        return $this->getEloquentQuery()
            ->when(method_exists(static::$model, 'scopeOrdered'), fn ($query) => $query->ordered())
            ->get();
    }

    public function getModel(): string
    {
        return Task::class;
    }

    protected function getViewData(): array
    {
        $records = $this->records();
        $statuses = $this->statuses()
            ->map(function ($status) use ($records) {
                $status['records'] = $this->filterRecordsByStatus($records, $status);

                return $status;
            });

        return [
            'statuses' => $statuses,
        ];
    }

    protected function filterRecordsByStatus(Collection $records, array $status): array
    {
        $statusIsCastToEnum = $records->first()?->getAttribute(static::$recordStatusAttribute) instanceof UnitEnum;

        $filter = $statusIsCastToEnum
            ? static::$statusEnum::from($status['id'])
            : $status['id'];

        return $records->where(static::$recordStatusAttribute, $filter)->all();
    }

    protected function getEloquentQuery()
    {
        // panel wise check
        return filament()->getCurrentPanel()->getId() == 'admin' ? Task::query() : Task::where('user_id',filament()->auth()->user()->id);
        // role and permission wise check

    }


    protected function getEditModalTitle(): string
    {
        return 'Edit Task';
    }
    public function form(Form $form): Form
    {
        return $form
            ->columns()
            ->schema($this->getEditModalFormSchema($this->editModalRecordId))
            ->statePath('editModalFormState')
            ->model($this->editModalRecordId ? static::$model::find($this->editModalRecordId) : static::$model);
    }

    protected function getEditModalFormSchema(?int $recordId): array
    {
        return [
            TextInput::make(static::$recordTitleAttribute)->columnSpanFull(),
            Forms\Components\DatePicker::make('start'),
            Forms\Components\DatePicker::make('end')
        ];
    }



}
