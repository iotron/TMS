<?php

namespace App\Filament\Resources\Project;

use App\Filament\Resources\Project\ProjectResource\Pages;
use App\Filament\Resources\Project\ProjectResource\RelationManagers;
use App\Models\Project\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Pages\Page;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $recordRouteKeyName = 'url';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\ViewProject::class,
           // Pages\EditProject::class,
            Pages\ManageTaskKanbanBoard::class,
            Pages\ManageTasks::class,
            Pages\ManageSprints::class,

        ]);
    }




        public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('url')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('start'),
                Forms\Components\DateTimePicker::make('end'),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255)
                    ->default('Not_Started'),
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
            ]);
    }



    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'view' => Pages\ViewProject::route('/{record:url}'),
            'edit' => Pages\EditProject::route('/{record:url}/edit'),
            'tasks' => Pages\ManageTasks::route('/{record:url}/tasks'),
            'kanban' => Pages\ManageTaskKanbanBoard::route('/{record:url}/kanban'),
            'sprints' => Pages\ManageSprints::route('/{record:url}/sprints'),
        ];
    }
}