<?php

namespace App\Filament\Resources\Project\ProjectResource\Pages;

use App\Filament\Resources\Project\ProjectResource;
use App\Models\User;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ManageUsers extends ManageRelatedRecords
{
    protected static string $resource = ProjectResource::class;

    protected static string $relationship = 'users';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return 'Users';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('email_verified_at')->default(now()),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255),

                Forms\Components\CheckboxList::make('roles')
                    ->relationship('roles', 'name',fn($query) => $query->whereNotIn('name',['super_admin','admin']))
                    ->columns()
                    ->getOptionLabelFromRecordUsing(fn(Model $record) => Str::headline($record->name))
                    ->searchable()


            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('email')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('roles.name')->badge(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->icon('heroicon-c-plus-circle'),
                Tables\Actions\AttachAction::make()
                    ->recordSelectSearchColumns(['name','email'])
                    ->preloadRecordSelect()
                    ->form(fn (Tables\Actions\AttachAction $action): array => [
                        $action->getRecordSelect()->placeholder('Select an user'),
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
//                Tables\Actions\Action::make('sync_role')
//                    ->label('Assign Role')
//                    ->fillForm(fn(Model $record) => $record->roles->toArray())
//                    ->icon('heroicon-c-adjustments-vertical')
//                    ->form([
//                        Forms\Components\CheckboxList::make('roles')
//                            ->relationship('roles','name',fn($query) => $query->whereNotIn('name',['super_admin','admin']))
//                            ->columns()
//                            ->getOptionLabelFromRecordUsing(fn(Model $record) => Str::headline($record->name))
//                            ->label(__('Assign Role'))
//                            ->required(),
//                    ])->action(function (Model $record,array $data){
//                        dd($data);
//                        $record->syncRoles($data);
//                    }),
                Tables\Actions\DetachAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DissociateBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
