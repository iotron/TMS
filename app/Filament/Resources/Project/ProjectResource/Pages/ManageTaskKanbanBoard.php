<?php

namespace App\Filament\Resources\Project\ProjectResource\Pages;

use App\Casts\StatusCast;
use App\Filament\Resources\Project\ProjectResource;
use App\Models\Project\Project;
use App\Models\Project\Task;
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

class ManageTaskKanbanBoard extends Page
{
    protected static string $resource = ProjectResource::class;

    use HasEditRecordModal;
    use HasStatusChange;
    use HasRelationManagers;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $relationship = 'tasks';

    #[Locked]
    public Model | int | string | null $record;

    protected static string $view = 'filament-kanban::kanban-board';
    //   protected static string $view = 'filament.resources.kanban-resource-page';

    protected static string $headerView = 'filament-kanban::kanban-header';

    protected static string $recordView = 'filament-kanban::kanban-record';

    protected static string $statusView = 'filament-kanban::kanban-status';

    protected static string $scriptsView = 'filament-kanban::kanban-scripts';

    protected static string $model = Task::class;

    protected static string $statusEnum = StatusCast::class;

    protected static string $recordTitleAttribute = 'name';

    protected static string $recordStatusAttribute = 'status';

    public static function getNavigationLabel(): string
    {
        return 'Kanban Board';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()->url(fn() => self::$resource::getUrl('view',['record' => $this->record->url])),

        ];
    }

    public function mount($record): void
    {
        $this->record = Project::firstWhere('url',$record);
        abort_unless($this->record,404);
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
        return Task::where('project_id',$this->record->id);
    }


}
