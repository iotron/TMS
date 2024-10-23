<?php

namespace App\Filament\Resources\Project\TaskResource\Pages;

use App\Filament\Resources\Project\TaskResource;
use App\Models\Project\Task;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Tables\Table;

class MyTasksList extends ListRecords
{
    protected static string $resource = TaskResource::class;
    protected static ?string $title = 'My Tasks';
    protected static ?string $breadcrumb = 'My Tasks';

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('view_all')
                ->label(__('View List'))
                ->icon('heroicon-c-eye')
                ->url(fn() => self::$resource::getUrl('list')),

            Actions\Action::make('Kanban')->icon('heroicon-m-squares-2x2')
                ->color('info')
                ->label('Kanban Board')->url(fn() => self::$resource::getUrl('kanban'))
        ];
    }



    public function getTaskTableQuery()
    {
        return  filament()->auth()->user()->tasks()->getQuery();
    }



    public  function table(Table $table): Table
    {
        return $table
            ->defaultGroup('status')
            ->query($this->getTaskTableQuery())
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('priority')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('project.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sprint.name')
                    ->default('--none--')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }





}
