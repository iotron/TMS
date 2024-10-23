<?php

namespace App\Filament\Resources\Project;

use App\Casts\PriorityCast;
use App\Casts\StatusCast;
use App\Filament\Resources\Project\ProjectResource\Widgets\FullCalendarTimelineWidget;
use App\Filament\Resources\Project\ProjectResource\Widgets\TaskTimelineWidget;
use App\Filament\Resources\Project\TaskResource\Pages;
use App\Filament\Resources\Project\TaskResource\RelationManagers;
use App\Models\Project\Task;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'My Tasks';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('For Project')
                    ->aside()
                    ->schema([
                        Forms\Components\Select::make('project_id')
                            ->relationship('project', 'name')
                            ->placeholder('Select a project'),
                    ]),

                Forms\Components\Section::make('Duration')
                    ->aside()
                    ->columns()
                    ->schema([
                        Forms\Components\DateTimePicker::make('start'),
                        Forms\Components\DateTimePicker::make('end'),
                    ]),

                Forms\Components\Section::make('About')
                    ->aside()
                    ->columnSpanFull()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->placeholder('Type Task Name')
                            ->lazy()
                            ->afterStateUpdated(fn($state,Forms\Set $set) => $set('url',Str::slug($state)))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('url')
                            ->required()
                            ->unique()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('description')
                            ->rows(5)
                            ->placeholder('Type about your task briefly')
                            ->maxLength(60000)
                            ->helperText('Tell other about your project under 60k characters')
                            ->columnSpanFull(),
                    ]),



                Forms\Components\Section::make('Manage')
                    ->aside()
                    ->columns()
                    ->schema([


                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->default(filament()->auth()->user()->id)
                            ->required(),
                        Forms\Components\TextInput::make('sprint_id')
                            ->numeric(),

                        Forms\Components\Select::make('status')
                            ->required()
                            ->options(collect(StatusCast::cases())->mapWithKeys(function ($case) {
                                return [$case->value => $case->getLabel()];
                            })->toArray())
                            ->default(StatusCast::TO_DO->value),




                        Forms\Components\Radio::make('priority')
                            ->required()
                            ->inline()
                            ->columnSpanFull()
                            ->options(collect(PriorityCast::cases())->mapWithKeys(function ($case) {
                                return [$case->value => $case->getLabel()];
                            })->toArray())
                            ->default(PriorityCast::LOW->value),

                    ]),







            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getWidgets(): array
    {
        return [
            FullCalendarTimelineWidget::class,
            TaskTimelineWidget::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\MyTasksList::route('/'),
            'list' => Pages\ListTasks::route('/view-all'),
            'kanban' => Pages\TaskKanbanBoard::route('/kanban-board'),
            'create' => Pages\CreateTask::route('/create'),
            'view' => Pages\ViewTask::route('/{record}'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
