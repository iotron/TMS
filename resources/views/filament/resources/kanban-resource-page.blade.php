<x-filament-panels::page>


    <div x-data wire:ignore.self class="md:flex overflow-x-auto overflow-y-hidden gap-4 pb-4">
        @if($statuses)
            @foreach($statuses as $status)
                @include(static::$statusView)
            @endforeach

                <div wire:ignore>
                    @include(static::$scriptsView)
                </div>

        @endif



    </div>

    @unless($disableEditModal)
        <x-filament-kanban::edit-record-modal/>
    @endunless



</x-filament-panels::page>
