<?php

namespace App\Filament\Resources\Project\ProjectResource\Pages;

use App\Filament\Resources\Project\ProjectResource;
use App\Infolists\Components\TiptapEntry;
use Awcodes\Scribble\ScribbleEntry;
use Filament\Actions;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\FontWeight;

class ViewProject extends ViewRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()->icon('heroicon-c-pencil-square'),
        ];
    }


    public function infolist(Infolist $infolist): Infolist
    {
        return parent::infolist($infolist)
            ->schema([

                Section::make('Task Information')
                    ->aside()
                    ->columns()
                    ->schema([
                        TextEntry::make('name')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->weight(FontWeight::Medium)
                            ->color('primary'),

                        TextEntry::make('status')->badge(),
                        TextEntry::make('start')->dateTime(),
                        TextEntry::make('end')->dateTime(),



//                         Custom Entry For Css Loading




                    ]),

                Section::make('Default Output')
                    ->schema([
                        TextEntry::make('description')
                            ->columnSpanFull()
                            ->alignJustify()->html(),
                    ]),

                Section::make('Custom Output')
                    ->schema([
                        TiptapEntry::make('description')
                            ->columnSpanFull()
                            ->alignJustify(),
                    ])

            ]);



    }


}
