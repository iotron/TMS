<?php

namespace App\Casts;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Mokhosh\FilamentKanban\Concerns\IsKanbanStatus;

enum StatusCast: string implements HasColor, HasIcon, HasLabel
{
    use IsKanbanStatus;
    case NOT_STARTED = 'Not_Started';
    case TO_DO = 'To_Do';
    case IN_PROGRESS = 'In_Progress';
    case IN_REVIEW = 'In_Review';
    case COMPLETED = 'Completed';
    case BLOCKED = 'Blocked';
    case ON_HOLD = 'On_Hold';
    case CANCELLED = 'Cancelled';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::NOT_STARTED => 'Not Started',
            self::TO_DO => 'To Do',
            self::IN_PROGRESS => 'In Progress',
            self::IN_REVIEW => 'In Review',
            self::COMPLETED => 'Completed',
            self::BLOCKED => 'Blocked',
            self::ON_HOLD => 'On Hold',
            self::CANCELLED => 'Cancelled',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::NOT_STARTED => 'secondary',
            self::TO_DO => 'info',
            self::IN_PROGRESS => 'warning',
            self::IN_REVIEW => 'primary',
            self::COMPLETED => 'success',
            self::BLOCKED => 'danger',
            self::ON_HOLD => 'muted',
            self::CANCELLED => 'dark',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::NOT_STARTED => 'heroicon-m-pause',
            self::TO_DO => 'heroicon-m-check-circle',
            self::IN_PROGRESS => 'heroicon-m-pause',
            self::IN_REVIEW => 'heroicon-m-eye',
            self::COMPLETED => 'heroicon-m-check',
            self::BLOCKED => 'heroicon-m-x-circle',
            self::ON_HOLD => 'heroicon-m-pause',
            self::CANCELLED => 'heroicon-m-pause',
        };
    }
}
